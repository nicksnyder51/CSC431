CSC431: Backend Group

Intro: 
The purpose of our group is to to handle the various data needs of the other teams by creating efficient scripts that create and retrieve data from our database.

Prerequisites:

Establishing a Linux server (EC2 instance) to host the scripts: ec2-user@ec2-18-220-98-102.us-east-2.compute.amazonaws.com/
Creating the MySQL database to store our data
Establishing Apache Web Server to host our website

Requirements:

	Functional Requirements:
Create and retrieve Cadastral Map
Save and retrieve data for Workshop Team
Save and retrieve data for Scanning Team
Save data for Workflow Team
Build system to support HTTP handling Requests
Create a system that handles authentication for username and password

	Nonfunctional Requirements:
Manage our data response time to be within a reasonable time frame
Used an Apache Web Server to host our website

How to Test:

The general format to run the scripts is first to enter the following in your browser: 

http://ec2-18-220-98-102.us-east-2.compute.amazonaws.com/

To select a particular script to run, append the scripts name to the link and, if the script takes arguments, start with a “?” followed by “&” after the first argument to delimit the arguments. Those scripts that start with “get” are for retrieving data while those lacking a “get” statement at the beginning involve the creation of new data in their respective tables. The following links are specific examples:

http://ec2-18-220-98-102.us-east-2.compute.amazonaws.com/getScanned.php?Scanned_ID=8 (retrieving data for scanning team with ID=8 as input)
http://ec2-18-220-98-102.us-east-2.compute.amazonaws.com/workshop.php?string_id=1234567&url=www.bing.com (data creation for workshop team with string_id and URL as input)
http://ec2-18-220-98-102.us-east-2.compute.amazonaws.com/workflow.php?polygonType=square&flag=a&editedBy=8&approvedBy=8&dateChanged=05/05/2018 (Save data for workflow team with polygonType, flag, editedBy, dateChanged)
