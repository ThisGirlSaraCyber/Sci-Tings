summary(iris)
# Sepal is part of plant that protects the  flower and provides structural support
plot(iris$Sepal.Length)
mean_iris <- mean(iris$Sepal.Length)
var_iris <- var(iris$Sepal.Length)
sd_iris <- sd(iris$Sepal.Length)

library(plotrix)
std.error(iris$Sepal.Length)


# Two ways of calculating confidence intervals
# Margin of error for 90% confidence interval
# alpha = 0.10
# z(alpha/2) = z(0.05)

# 1: If you are given standard deviation
me <- qnorm(0.05)*(sd_iris/sqrt(150))
up_iris <-mean_iris - me 
lb_iris <- mean_iris + me

#2: If you are not given standard deviation, you have to estimate it as follows
# Note the second parameter in the qt() function is 149, because we are using (N - 1) 
me <- qt(.05,149)*sd(iris$Sepal.Length)/ sqrt(150)

# Data distribution
hist(iris$Sepal.Length)

# Normal QQ Plot
qqnorm(iris$Sepal.Length)
