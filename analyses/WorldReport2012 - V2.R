#install.packages('tabulizer')
#install.packages('stringr')
#install.packages('tibble')
#install.packages('ggplot2')

library(tabulizer)
library(stringr)
library(tibble)
library(ggplot2)

#====================================================
### READ DATA ###
#====================================================

# Read in data with tabularize and generate data frame
WorldReport2012 <- 'http://siteresources.worldbank.org/INTWDR2012/Resources/7778105-1299699968583/7786210-1315936222006/Complete-Report.pdf'
WorldReport2012Part1 <- extract_tables(WorldReport2012, pages = 418)
WorldReport2012Part2 <- extract_tables(WorldReport2012, pages = 419)
WorldReport2012Part1 <- do.call(rbind, WorldReport2012Part1)
WorldReport2012Part2 <- do.call(rbind, WorldReport2012Part2)
WorldReport2012Part1 <- as.data.frame(WorldReport2012Part1[8:nrow(WorldReport2012Part1), ],stringsAsFactors=FALSE)
WorldReport2012Part2 <- as.data.frame(WorldReport2012Part2[8:nrow(WorldReport2012Part2), ],stringsAsFactors=FALSE)
WorldReport2012Table <- rbind(WorldReport2012Part1, WorldReport2012Part2)

# Set column names
colnames(WorldReport2012Table) = c('Country name','Population - millions', 'Population - Average Annual % Growth',
                                   'Population - Density people per sq. km','Population age composition % - Ages 0-14',
                                   'GNI - ($) billions','PPP - $ billions','GDP per capita % growth',
                                   'Life expectancy - Male (yrs)','Adult literacy % rate - % ages 15+')

# Add columns from original dataset and set values to NA
WorldReport2012Table = add_column(WorldReport2012Table,'GNI - $ per capita'=NA, .after=6)
WorldReport2012Table = add_column(WorldReport2012Table,'PPP - $ per capita'=NA, .after=8)
WorldReport2012Table = add_column(WorldReport2012Table,'Life expectancy - Female (yrs)'=NA, .after=11)

#====================================================
### FUNCTIONS ###
#====================================================
unmerge_columns <- function(df){
  for(row in 1:nrow(df)){
    temp = str_split_fixed(df[row,]$`GNI - ($) billions`," ",n=2)
    df[row,]$`GNI - ($) billions` = temp[1]
    df[row,]$`GNI - $ per capita` = temp[2]
    
    temp = str_split_fixed(df[row,]$`PPP - $ billions`," ",n=2)
    df[row,]$`PPP - $ billions` = temp[1]
    df[row,]$`PPP - $ per capita` = temp[2]
    
    temp = str_split_fixed(df[row,]$`Life expectancy - Male (yrs)`, " ", n=2)
    df[row,]$`Life expectancy - Male (yrs)` = temp[1]
    df[row,]$`Life expectancy - Female (yrs)` = temp[2]
  }
  return(df)
}

removeBadCharacters <- function(df){
  for(row in 1:nrow(df)){
    for(col in 1:ncol(df)){
      if(str_detect(df[row,col],"â€“")){
        df[row,col] = paste("-",gsub("[^.0-9]", "", df[row,col]),sep="") # Replace bad character with negative sign
      }
      if(str_detect(df[row,col],"\\.\\.")){
        df[row,col] = NA
      }
      df[row,col] = gsub(',','',df[row,col]) # Removes Commas from numbers
    }
  }
  return(df)
}

removeFootnotes <-function(df){
  for(row in 1:nrow(df)){
    for(col in 2:ncol(df)){ # Want to skip the country column
      df[row,col] = gsub('[a-zA-Z]','',df[row,col])
      
    }
  }
  return(df)
}

#====================================================
### FUNCTION CALLS  ###
#====================================================
WorldReport2012Table <- unmerge_columns(WorldReport2012Table)
WorldReport2012Table <- removeBadCharacters(WorldReport2012Table)
WorldReport2012Table <- removeFootnotes(WorldReport2012Table)

# Manually fix Latin America and Caribbean name
WorldReport2012Table = WorldReport2012Table[-141,]
WorldReport2012Table[141,1] = "Latin America and the Caribbean"

#====================================================
### DATA VISUALIZATION  ###
#====================================================
# To convert character data to numeric data: 
#WorldReport2012Table<- data.frame(WorldReport2012Table$`Country name`,lapply(WorldReport2012Table[,2:13], as.numeric))

WorldReport2012Table$`Population - millions` = as.numeric(WorldReport2012Table$`Population - millions`)
ggplot(data = WorldReport2012Table , aes(x = WorldReport2012Table$`Country name`, y=WorldReport2012Table$`Population - millions`))+ 
geom_bar(stat="identity") + labs(x="Country", y = "Population - millions")+
theme(axis.text.x = element_text(angle = 70, hjust = 1))+
ggtitle("World Development Report 2012 - Countries by Population")
