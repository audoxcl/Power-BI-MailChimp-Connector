# Power BI MailChimp Connector

## Description

The purpose of this connector is to access MailChimp data from Power BI so you can create more advanced reports.

This connector can also be used to extract data from MailChimp with any other purpose, i.e. you can extract data to load it into a database.

## Instructions

1. Copy files to your server so you can access it via url like:
https://yourdomain.com/Power-BI-MailChimp-Connector/index.php
2. Edit file auth.php to restrict access to this connector giving authorization only to valid tokens.
3. Start your Power BI report using our template available at:
https://github.com/audoxcl/Power-BI-Examples/blob/main/MailChimp.pbix

In Power BI Desktop you should set all these parameters (in the Power Query Editor window):

1. **url:** the url where the connector is installed.
2. **token:** the token used to use the connector. See auth.php file to change the way this token is validated. The token 'FREETOKEN' will work until you edit auth.php file. Also, you can add multiple tokens in auth.php file.
3. **datacenter:** the MailChimp datacenter for your company. This datacenter is also used in Power BI report to create the url link to each record inside your MailChimp account. The datacenter is located in your MailChimp url account (i.e.: us1, us2, etc.).
4. **mailchimp_api_key:** the api key to access MailChimp data. This token is created in your MailChimp account.

This connector might be limited due to MailChimp API rate limitations.

## Contact Us:

- www.audox.com
- info@audox.com