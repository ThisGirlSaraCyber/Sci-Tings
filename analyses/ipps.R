# Medicare data
# https://data.cms.gov/Medicare-Inpatient/Inpatient-Prospective-Payment-System-IPPS-Provider/97k6-zzx3
# Note the Average Total Payments is always greater than the Average Medicare Payments
# Metadata: https://data.cms.gov/api/views/97k6-zzx3/files/4496fc4f-5f10-43e4-8183-b6da867f8981?download=true&filename=Medicare_Hospital_Inpatient_PUF_Methodology_2017-08-30.pdf
# This takes a while to run because of the vast number of locations to geocode.
# Make sure the Google Maps Static IP is enabled on your API Key

library(ggmap)
library(xlsx)
library(dplyr)

#Remember to set your current working directory here with the setwd() command

ipps <- read.csv('data/Inpatient_Prospective_Payment_System__IPPS__Provider_Summary_for_the_Top_100_Diagnosis-Related_Groups__DRG__-_FY2011.csv')

ipps %>% distinct(DRG.Definition)

# Lets plot psychoses cases
psychoses <- ipps %>% filter(DRG.Definition == "885 - PSYCHOSES")

for (i in 1:nrow(psychoses)){
  psychoses$fullAddress[i] <- paste0(psychoses$Provider.Street.Address[i]," ",psychoses$Provider.City[i]," ", psychoses$Provider.State[i])
}

register_google(key = "GOOGLE API KEY GOES HERE")
geocodedAddresses <- geocode(psychoses$fullAddress)

get_map("United States", zoom = 4) %>% ggmap() + geom_point(data=geocodedAddresses, color='red', size=3) + 
  ggtitle(label = 'Location of Hospitals for Medicare Psychoses',subtitle = 'Source: data.gov') +
  theme(axis.line = element_blank(),
        axis.text = element_blank(),
        axis.ticks = element_blank(),
        plot.margin = unit(c(0, 0, -1, -1), 'lines')) +
  xlab('') +
  ylab('')
ggsave("ipps.png",plot=last_plot(), device = "png")
