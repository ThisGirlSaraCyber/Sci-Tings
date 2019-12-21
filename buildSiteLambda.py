import json
import boto3
from botocore.client import Config
import io
import zipfile

def lambda_handler(event, context):

	sns = boto3.resource('sns')
	topic = sns.Topic('arn:aws:sns:us-east-1:076858682202:DeploySciTingsTopic')
	location={
		"bucketName": 'build.sci-tings.org',
		"objectKey": 'sci-tings-build.zip'
	}
	try:
		job = event.get("CodePipeline.job")
		if job:
			for artifact in job["data"]["inputArtifacts"]:
				if artifact["name"] == "MyAppBuild":
					location = artifact["location"]["s3Location"]
		
		print("Building Sci - Tings from", str(location))
		s3 = boto3.resource('s3',config = Config(signature_version = 's3v4'))

		st_bucket = s3.Bucket('sci-tings.org') # Name of source code bucket
		build_bucket = s3.Bucket(location["bucketName"]) # Name of bucket that holds build artifact
		
		st_zip = io.BytesIO() # holds file object in memory temporarily
	    
	    # Download build artifact
		print("Downloading build artifact.........")
		build_bucket.download_fileobj(location["objectKey"],st_zip)

		# Uploading files to source code bucket
		with zipfile.ZipFile(st_zip) as myzip: # Provide alias name to build artifact zip file
			for nm in myzip.namelist(): # Iterate through files in ZIP
				obj = myzip.open(nm) # Store individual file
				st_bucket.upload_fileobj(obj,nm) # Upload file to source bucket
				st_bucket.Object(nm).Acl().put(ACL="public-read") # Give file object public-read permissions
				print("uploaded....",nm)

		topic.publish(Subject="Sci-Tings Deployment", Message="It looks like Sci-Tings has been deployed. Please check the site to verify a successful deployment.")
		if job:
			codepipeline = boto3.client('codepipeline')
			codepipeline.put_job_success_result(jobId=job["id"])
	except:
		topic.publish(Subject="Sci-Tings Deployment Failed", Message = "Sci-Tings failed to deploy.")
		raise
	return {
		'statusCode': 200,
		'body': json.dumps('Hello from Sci-Tings!')
	}
