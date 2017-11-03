Upload Style
=================
Upload Style enables you to upload styles' zip files or delete styles' folders from the server.
With this extension you can install/update/delete styles without using FTP. If the uploaded style already exists, it will be updated with the uploaded files.

[![Build Status](https://travis-ci.org/ForumHulp/uploadstyle.svg?branch=master)](https://travis-ci.org/ForumHulp/uploadstyle)

## Requirements
* phpBB 3.1.0-dev or higher
* PHP 5.3.3 or higher

## Installation
You can install this extension on the latest copy of the develop branch ([phpBB 3.1-dev](https://github.com/phpbb/phpbb3)) by doing the following:

1. Download the [latest ZIP-archive of `master` branch of this repository](https://github.com/ForumHulp/uploadstyle/archive/master.zip).
2. Check out the existing of the folder `/ext/forumhulp/uploadstyle/` in the root of your board folder. Create folders if necessary.
3. Copy the contents of the downloaded `upload-master` folder to `/ext/forumhulp/uploadstyle/`.
4. Navigate in the ACP to `Customise -> Extension Management -> Manage extensions -> Upload Style`.
5. Click `Enable`.
6. Or use our ([Upload Extensions](https://github.com/ForumHulp/upload)).

## Usage
### Upload Style
To upload styles navigate in the ACP to `Style management -> Upload style`.
Choose your style zip file and click upload. The extension will unpack your file in the folder mentioned in style.cfg. After that you can enable the uploaded style in `Install Styles` page (or simply click the link `Enable the uploaded style`).

### Delete style
To delete styles' folders from the server (to perform complete uninstallation) make sure that your style is disabled.
Then navigate in the ACP to `Customise -> `Style management -> Upload style`.
Choose the style that you want to delete and click `Delete style`.

## Update
1. Download the [latest ZIP-archive of `master` branch of this repository](https://github.com/ForumHulp/uploadstyle/archive/master.zip).
2. Navigate in the ACP to `Customise -> Extension Management -> Manage extensions -> Upload Style` and click `Disable`.
3. Copy the contents of the downloaded `upload-master` folder to `/ext/forumhulp/uploadstyle/`.
4. Navigate in the ACP to `Customise -> Extension Management -> Manage extensions -> Upload Style` and click `Enable`.
5. Click `Details` or `Re-Check all versions` link to follow updates.

## Uninstallation
Navigate in the ACP to `Customise -> Extension Management -> Manage extensions -> Upload Style` and click `Disable`.

For permanent uninstallation click `Delete Data` and then you can safely delete the `/ext/forumhulp/uploadstyle/` folder.
Or use our ([Upload Extensions](https://github.com/ForumHulp/upload)).

We feel sorry as our answers on phpbb sites are removed, so use github or our forum for answers.

## License
[GNU General Public License v2](http://opensource.org/licenses/GPL-2.0)

© 2014 - John Peskens (http://ForumHulp.com)