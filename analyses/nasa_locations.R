# This example shows how to use the ggmap library and Google Maps API to make some cool graphs
# Data source: https://catalog.data.gov/dataset/47943633-de44-4b70-83b7-ab09b8a3d1ee/resource/f3e07c50-8318-47aa-a127-46dff9835a61
#install.packages('ggmap')
library(ggmap)
library(xlsx)
library(dplyr) # For filtering data

# Set your working directory with the setwd() command

# Read the data
nasa <- read.xlsx(file = 'data/NASA_Labs_Facilities.xlsx',sheetName ='Sheet1')

# Find distinct addresses as there are many duplicates
unique_address <- nasa %>% distinct(Address,City,State)

# Create a column with the full addresses
for (i in 1:nrow(unique_address)){
  unique_address$fullAddress[i] <- paste0(unique_address$Address[i]," ",unique_address$City[i]," ", unique_address$State[i])
}

# Now, the full address column can be geocoded (this means that a regular street address can be converted to lat/long and plotted on the map)
geocodedAddresses <- geocode(unique_address$fullAddress)


# Example map of the United States
# us <- c(left = -125, bottom = 25.75, right = -67, top = 49)
# get_stamenmap(us, zoom = 5, maptype = "toner-lite") %>% ggmap()

# Example map of Shreveport
#get_googlemap("shreveport louisiana", zoom = 12) %>% ggmap()

# Enable Google Maps API key
register_google(key = "Google Maps API KEY GOES HERE")

# Create the map
get_map("United States", zoom = 4) %>% ggmap() + geom_point(data=geocodedAddresses, color='red', size=3) + 
  ggtitle(label = 'Federal R&D Facilities for Entrepreneurs and Innovators',subtitle = 'Source: data.gov') +
  theme(axis.line = element_blank(),
        axis.text = element_blank(),
        axis.ticks = element_blank(),
        plot.margin = unit(c(0, 0, -1, -1), 'lines')) +
  xlab('') +
  ylab('')

ggsave("nasaLocations.png",plot=last_plot(), device = "png")
