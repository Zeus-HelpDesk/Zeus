# Filesystems

---

- [Local](#local)
- [AWS S3](#s3)
- [AWS S3 Compatible](#s3-compatible)

> {warning} Always plan for future use, failing to do so may result in application failures or other major issues in the future, files should always be backed up and you should plan to have lots of room for the future

<a name="local"></a>
## Local
Local Storage is the storage that your server or device has via a hard drive or SSD, depending on your deployment this may be limited by your hosting provider or your physical drive itself. Files are stored in the `storage/` directory for all app storage and `storage/public` for any public storage.
This application will automatically use the local storage provider by default.

<a name="s3"></a>
## AWS S3
Amazon Web Services S3 object storage is an excellent choice to store your files if you have a highly distributed setup or if you plan on storing a very large amount of data. Currently this application only stores backups and some special automated learning files on the disk, however some future features may allow users to upload files.

To enable AWS S3 storage for your application will need to make the following changes to `.env`:

```bash
FILESYSTEM_DRIVER=s3
AWS_ACCESS_KEY_ID=keyId
AWS_SECRET_ACCESS_KEY=secret
AWS_DEFAULT_REGION=region
AWS_BUCKET=bucket
AWS_URL=https://s3.amazonurl.tld
```
> {primary} S3 and S3 Compatible storage methods are cached on your redis server for performance reasons. With the prefix `s3-cache`

<a name="s3-compatible"></a>
## AWS S3 Compatible
S3 Compatible storage refers to a storage system that has a S3 compatible api a good example of such a system is [Minio](https://minio.io/) these systems can be configured using the same configuration as the AWS s3 configuration except you must add `AWS_ENDPOINT` to be pointed at your server.
