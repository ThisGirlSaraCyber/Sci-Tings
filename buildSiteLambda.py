import json
import boto3
from botocore.client import Config
import io
import zipfile

def lambda_handler(event, context):

    s3 = boto3.resource('s3',config = Config(signature_version = 's3v4'))
    
    st_bucket = s3.Bucket('sci-tings.org') # Name of source code bucket
    build_bucket = s3.Bucket('build.sci-tings.org') # Name of bucket that holds build artifact
    
    st_zip = io.BytesIO() # holds file object in memory temporarily
    
    # Download build artifact
    print("Downloading build artifact.........")
    build_bucket.download_fileobj('sci-tings-build.zip',st_zip)
    
    # Uploading files to source code bucket
    with zipfile.ZipFile(st_zip) as myzip: # Provide alias name to build artifact zip file
    	for nm in myzip.namelist(): # Iterate through files in ZIP
    		obj = myzip.open(nm) # Store individual file
    		st_bucket.upload_fileobj(obj,nm) # Upload file to source bucket
    		st_bucket.Object(nm).Acl().put(ACL="public-read") # Give file object public-read permissions
    		print("uploaded....",nm)
    return {
        'statusCode': 200,
        'body': json.dumps('Hello from Sci-Tings!')
    }
