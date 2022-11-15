Instructions for This Lab
 - Remember you need an S3 Bucket 
 - You should have two folders in the S3 Bucket AZ1A and AZ1B as per the video demo
 - In this folder you have the necessary folders and relative index and health files so copy them accordingly
 - You need to create the IAM Role
 - Then copy the Elastic Load Balancer Script for EC2 to the userdata of your EC2 Deployment, making sure to change the bucket and folder names accordingly in the cript first. Review the video along with editing the script to ensure you get the syntax correct.

Important Note - The script will only work with the previous generation of Linux AMI (not the Linux2 AMI). For example, the Linux AMI - Amazon Linux AMI 2018.03.0 (HVM), SSD Volume Type - ami-0765d48d7e15beb93

