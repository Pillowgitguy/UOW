from azure.storage.blob import BlobServiceClient, BlobClient, ContainerClient
from google.cloud import storage
import os
import boto3
from azure.core.exceptions import ResourceNotFoundError
from azure.core.exceptions import ResourceNotFoundError
import botocore.exceptions
from google.cloud.exceptions import NotFound
######################################### AZURE Cloud##################################################################
# Initialize a BlobServiceClient using a connection string
connect_str = "DefaultEndpointsProtocol=https;AccountName=trustsharing;AccountKey=;EndpointSuffix=core.windows.net"
blob_service_client = BlobServiceClient.from_connection_string(connect_str)

# azure container name
azure_container_name = "trustsharing"


def azure_upload(blob, share):
    # Upload a file
    blob_client = blob_service_client.get_blob_client(
        container=azure_container_name, blob=blob)
    blob_client.upload_blob(share)


def azure_download(blob_name, local_file_name):
    container_client = blob_service_client.get_container_client(
        azure_container_name)
    blob_client = container_client.get_blob_client(blob_name)

    try:
        # Check if the blob exists
        blob_properties = blob_client.get_blob_properties()

        # Download the blob to a local file
        with open(local_file_name, "wb") as download_file:
            download_file.write(blob_client.download_blob().readall())
        print(f"Blob {blob_name} downloaded to {local_file_name}.")
        return True
    except ResourceNotFoundError:
        print(f"Blob {blob_name} does not exist. Skipping download.")
        return False


def azure_delete(blob_name):
    try:
        blob_client = blob_service_client.get_blob_client(
            container=azure_container_name, blob=blob_name)
        blob_client.delete_blob()
        print(f"Blob {blob_name} successfully deleted.")
        return True
    except ResourceNotFoundError:
        print(f"Blob {blob_name} not found. Cannot delete.")
        return False


######################################### Google cloud##################################################################


os.environ["GOOGLE_APPLICATION_CREDENTIALS"] = "users/endUser/trustsharing_keyfile.json"
client = storage.Client()
bucket_name = "trustsharing"


def google_upload(source_file_name, destination_blob_name):
    """Uploads a file to the specified bucket."""
    storage_client = storage.Client()
    bucket = storage_client.bucket(bucket_name)
    blob = bucket.blob(destination_blob_name)

    blob.upload_from_filename(source_file_name)

    print(f"File {source_file_name} uploaded to {destination_blob_name}.")


def google_download(source_blob_name, destination_file_name):
    storage_client = storage.Client()
    bucket = storage_client.bucket(bucket_name)
    blob = bucket.blob(source_blob_name)

    try:
        # Check if the blob exists
        blob.reload()

        # Download the blob to a local file
        blob.download_to_filename(destination_file_name)
        print(f"Blob {source_blob_name} downloaded to {
              destination_file_name}.")
        return True
    except NotFound:
        print(f"Blob {source_blob_name} does not exist. Skipping download.")
        return False


def google_delete(blob_name):
    try:
        bucket = client.bucket(bucket_name)
        blob = bucket.blob(blob_name)
        blob.delete()
        print(f"Blob {blob_name} successfully deleted from Google Cloud.")
        return True
    except NotFound:
        print(f"Blob {blob_name} not found in Google Cloud. Cannot delete.")
        return False


######################################### Amazon aws##################################################################


# Initialize a session using your AWS credentials
bucket_name = 'trustsharing'


def aws_upload(source_file_name, destination_blob_name):
    print(source_file_name)
    print(destination_blob_name)
    s3 = boto3.client('s3', aws_access_key_id='',
                      aws_secret_access_key='')
    s3.upload_file(source_file_name, bucket_name, destination_blob_name)


def aws_download(source_file_name, destination_blob_name):
    s3 = boto3.client('s3', aws_access_key_id='',
                      aws_secret_access_key='')

    try:
        # Check if the object exists
        s3.head_object(Bucket=bucket_name, Key=source_file_name)

        # Download the object to a local file
        s3.download_file(bucket_name, source_file_name, destination_blob_name)
        print(f"Object {source_file_name} downloaded to {
              destination_blob_name}.")
        return True
    except botocore.exceptions.ClientError as e:
        if e.response['Error']['Code'] == "404":
            print(
                f"Object {source_file_name} does not exist. Skipping download.")
        else:
            raise  # If there's an error other than 'Not Found'


def aws_delete(blob_name):
    s3 = boto3.client('s3', aws_access_key_id='',
                      aws_secret_access_key='')
    try:
        s3.delete_object(Bucket=bucket_name, Key=blob_name)
        print(f"Object {blob_name} successfully deleted from S3.")
        return True
    except botocore.exceptions.ClientError as e:
        error_code = int(e.response['Error']['Code'])
        if error_code == 404:
            print(f"Object {blob_name} not found in S3. Cannot delete.")
            return False
        else:
            raise
