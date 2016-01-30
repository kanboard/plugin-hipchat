Hipchat plugin for Kanboard
===========================

[![Build Status](https://travis-ci.org/kanboard/plugin-hipchat.svg?branch=master)](https://travis-ci.org/kanboard/plugin-hipchat)

Receive Kanboard notifications on Hipchat.

Author
------

- Frederic Guillot
- License MIT

Installation
------------

- Create a folder **plugins/Hipchat**
- Copy all files under this directory

Configuration
-------------

### Hipchat API Settings

Firstly, you need to generate a new API token on Hipchat website, then configure Kanboard.

Go to **Settings > Integrations > Hipchat** and fill the form:

- **Hipchat API URL**: If you use the self-hosted version of Hipchat, define the API URL here
- **Hipchat API Token**: Copy and paste the token generated from your Hipchat account

### Receive individual user notifications

- You must have the same email address between your Hipchat account and your Kanboard profile
- Then enable Hipchat notifications in your profile: **Notifications > Select Hipchat**

### Receive project notifications to a room

- Go to the project settings then choose **Integrations > Hipchat**
- **Room API ID or name**: Enter the Hipchat room name (case sensitive) or the API ID
- **Room notification token**: Enter to room token or leave it blank to use the global API token

## Troubleshooting

- Enable the debug mode
- All connection errors with the API are recorded in the log files `data/debug.log` or syslog
