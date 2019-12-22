# Bar chart of City of Shreveport revenue by department
# @jjain :: 7/13/2019


# Download data set here: https://drive.google.com/open?id=1Um0VE3zjgkd3JcgrbKvlxhzmvQOMaK6k 
expenses <- read.csv('data/01_Expenses By FundRevenues By Fund.csv',header=TRUE)
# install.packages('ggplot2')
library(ggplot2)
#expenses <- expenses[1:10,]
ggplot(data=expenses, aes(x=reorder(category_name,-sum), y = sum)) + theme(axis.text.x = element_text(angle = 70, hjust = 1)) +
  geom_col() + scale_y_continuous(labels = scales::comma) + labs(x="Category", y = "Revenue ($)")+geom_bar(stat="identity",fill = "#FF6666")+
  ggtitle("Shreveport City Budget by Department (2018)",)
#setwd("img/")
ggsave("expense.png",plot=last_plot(), device = "png")
