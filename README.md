Hipchat Plugin for Kanboard
===========================

[![Build Status](https://travis-ci.org/kanboard/plugin-hipchat.svg?branch=master)](https://travis-ci.org/kanboard/plugin-hipchat)

Receive Kanboard notifications on Hipchat.

Author
------

- Frederic Guillot
- License MIT

Requirements
------------

- Kanboard >= 1.0.29
- Hipchat API credentials

Installation
------------

You have the choice between 3 methods:

1. Install the plugin from the Kanboard plugin manager in one click
2. Download the zip file and decompress everything under the directory `plugins/Hipchat`
3. Clone this repository into the folder `plugins/Hipchat`

Note: Plugin folder is case-sensitive.

Configuration
-------------

### Hipchat API Settings

Firstly, you need to generate a new API token on Hipchat, then configure Kanboard.

Go to **Settings > Integrations > Hipchat** and fill the form:

- **Hipchat API URL**: If you use the self-hosted version of Hipchat, define the API URL here
- **Hipchat API Token**: This is the global API token, this is optional. It will be used globally for all users

### Receive individual user notifications

- Generate an Hipchat API token and copy and paste the token here: **Your user profile > Integrations > Hipchat API Token**
- Then enable Hipchat notifications in your profile: **Notifications > Select Hipchat**
- You must have the same email address between your Hipchat account and your Kanboard profile

### Receive project notifications to a room

- Go to the project settings then choose **Integrations > Hipchat**
- **Room API ID or name**: Enter the Hipchat room name (case sensitive) or the API ID
- **Room notification token**: Enter to room token or leave it blank to use the global API token

Troubleshooting
---------------

- Enable the debug mode
- All connection errors with the API are recorded in the logs
