# Storing Backups in Google Drive

---

- [Basic Overview](#basic-overview)
- [Google Credentials](#google-credentials)
- [Final Testing](#final-testing)

<a name="basic-overview"></a>
## Basic Overview
As part of this application automated backups are enabled by default and can not be disabled, these backups are saved both to the local disk as well as a location in a google drive space, it is recommended that you create a user that is for these backups or for the application in general.

> {warning} These backups are strictly the database and do not contain any user uploaded files or the application itself. It is recommended to use Amazon S3 or another supported storage provider to store uploaded user content.

<a name="google-credentials"></a>
## Google Credentials
You will need a set of google credentials in order for the Google Drive backups to work properly. These google credentials will also be used for the general use Google storage provider if you wish.

Go to the [Google Developer Console](https://console.developers.google.com/?pli=1) and then create a project.

![Google Developers Console Create Project](https://cdn-images-1.medium.com/max/1600/1*Ln9WiBCMbWbz70hyDGqqNg.png)

After you enter a name, it takes a few seconds before the project is successfully created on the server.

Make sure you have the project selected at the top.

Then go to Library and click on “Drive API” under “Google Apps APIs”:

![Google API Libraries](https://cdn-images-1.medium.com/max/1600/1*aUpUzNp-UpbE8g9fcuEmxg.png)

And then enable the Google Drive API.

Then, go to “Credentials” and click on the tab “OAuth Consent Screen”. Fill in a “Product name shown to users” and Save it. Don’t worry about the other fields, you can leave these blank as they are not required for this application to work properly.

![Google Oauth Consent Screen Configuration](https://cdn-images-1.medium.com/max/1600/1*C3WOyZ-2whvEQLrCoTSWvg.png)

Then go back to Credentials, click the button that says “Create Credentials” and select “OAuth Client ID”.

![Google Close up](https://cdn-images-1.medium.com/max/1600/1*7SuyJdjDkMQHwgXNXehijg.png)

Choose “Web Application” and give it a name.

Enter your “Authorized redirect URIs”, your production URL (https://zeus.schoolsite.org) — or create a separate production key later.

Also add https://developers.google.com/oauthplayground temporarily, because you will need to use that in the next step.

![Google Credentials Creator](https://cdn-images-1.medium.com/max/1600/1*TBXNunE0__GxFqZE0a1zxw.png)

Click Create and take note of your Client ID and Client Secret.

You should put the Client ID in your `.env` file under: `GDRIVE_CLIENT_ID` and you should also put the Client Secret in your `.env` file under: `GDRIVE_CLIENT_SECRET`

Now head to https://developers.google.com/oauthplayground.

Make sure you added this URL to your Authorized redirect URIs in the previous step.

In the top right corner, click the settings icon, check “Use your own OAuth credentials” and paste your Client ID and Client Secret.

![](https://cdn-images-1.medium.com/max/1600/1*sAZdR19_830btp6G1ZTJCA.png)

In step 1 on the left, scroll to “Drive API v3”, expand it and check each of the scopes.

![](https://cdn-images-1.medium.com/max/1600/1*WaFBYCD121YS4fH3RfdYXA.png)

Click “Authorize APIs” and allow access to your account when prompted.

When you get to step 2, check “Auto-refresh the token before it expires” and click “Exchange authorization code for tokens”.

![](https://cdn-images-1.medium.com/max/1600/1*DqkjAP93N8nR4nFo5jXrPw.png)

When you get to step 3, click on step 2 again and you should see your refresh token.

![](https://cdn-images-1.medium.com/max/1600/1*YVMUwSS0eEGz_gVrFAfu1g.png)

Add this refresh token to your .env file under: `GDRIVE_REFRESH_TOKEN`

Finally if you would like the backups to save in a specific Google Drive directory you can do so by copying the end part of the url:

![](https://cdn-images-1.medium.com/max/1600/1*ObB4MuuH1gzKusw5wFk-bg.png)

You should set `GDRIVE_BACKUP_FOLDER_ID` to this value

<a name="final-testing"></a>
## Final Testing
To to test that the backup functionality is working as expected you should open a command console in your application folder and run `php artisan backup:run --only-db`