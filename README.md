# Deevya-Myob-Devops
Myob Devops Technical Test

# Deevya-Myob-Devops
Myob Devops Technical Test

by Deevya Naresh

Live site: http://deevya.com/Deevya-devops/

# Summary
Written API endpoints, deployable to PHP/Wamp Server , to return data in JSON format as per the requirements,
Built PHPUnit tests, to evaluate the PHP code and the API integrations
Constructed a code deployment mechanisim in PHP, that accepts Webhooks from GitHub and deploys the code base 
Registered & connected to Travis CI build evaluation system. Although, I had not used TravisCI, We now have a TravisCI build page along with a build status badge

Created a simple web interface to discover and execute the API's
# 1. Overview
Getting Started
Prerequisites
Contributing
Versioning
Authors
Acknowledgments

# 1.1. Getting Started
These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. See deployment for notes on how to deploy the project on a live system.

# 1.2 Prerequisites
What things you need to install the software, and how to install them

git - distributed version control system
PHP - Language
PHPUnit - Testing
Wamp - Wamp HTTP Server Project


# 1.2.2 Online / remote systems
Remote online systems used by the project are;

Github - an implementation of the git distributed version control system
travis-ci.org - cCloud based CI / Build system


# 1.3 Authors
Deevya Naresh - Initial work

2. Installing
Here we describe how to retrieve the sources code and install any prerequisites

Clone
Configure
Github Webhook
Deploy Handler
Deploy
Quick version

git clone git@github.com:DeevyaNaresh/Deevya-Myob-Devops.git

make clean configure
make tests
make clean deploy-handler-all
validate deployment hook at Deevya-myob-devops/settings/hook
make deploy
make get-version
make VERSION=x.y.z bump-version
note: make help returns a formatted list of targets and descriptions
2.1 Clone
Clone the GitHUB repository

git clone git@github.com:Deevya/Deevya-myob-devops.git
Cloning into 'Deevya-Myob-Devops'...

Receiving objects: 100% (116/116), 574.75 KiB | 469.00 KiB/s, done.
Resolving deltas: 100% (53/53), done.

# 2.2 Configure
validate we have the required prerequisite software to execute from this location

make clean configure
Download PHPUnit
Verify PHPUnit
PHPUnit 7.0.2 by Sebastian Bergmann and contributors.

# 2.3 Github Webhook
This code base will make use of the GitHUB webhook system to allow delivery of software to the end host.

Open browser
Navigate to: https://github.com/DeevyaNaresh/Deevya-Myob-Devops/settings/hooks

CLick () Send me everything.
CLick "Add Webhook"

# 2.4 Deploy Handler
Required, if you would like to have the code update based on commits, to the master branch. I would suggest a future version would accept and check that the code has come from a Pull Request (PR)

first deploy - make clean deploy-handler-all
just handle code - make deploy-handler-upload-code
deploy handler: clean
deploy handler: key config
deploy handler: upload keys
deploy                                                   100% 1675     7.2KB/s   00:00
deploy handler: upload ssh config
deploy-ssh-config.txt                                    100%  125     0.6KB/s   00:00
deploy handler: configure deploy ssh
deploy handler: upload code
deploy.php                                               100% 1650     7.7KB/s   00:00

# 2.5  Deploy
We have two deployment methods here, direct via SCP with a packaged ZIP file, and via GitHUB. There may be times when we want to deploy directly on to the host without GitHUB.

# 2.5.1 Deploy directly
Here we will package up the entire project as a ZIP file and deliver it to the host system, there it will be unpacked

steps to deploy: package, upload keys, upload code

make package
make DEST=<folder name> deploy
folder name = the name of the folder inside the webroot directory

make DEST=Deevya-Myob-Devops deploy

this will deploy the packaged zip to the folder /Deevya-myob-devops
example We deploy the codebase to the host, where the API's will be available at

make package
make DEST=Deevya-myob-devops deploy
The API's are now available at http://Deevya.com/staging/Deevya-myob-devops/api

e.g. http://Deevya.com/staging/Deevya-myob-devops/api/health.php

# 2.5.2 Deploy via Commit
This relies on the deploy-hanlder, so must be deployed before pushed commits will have an affect.

# 2.5.2.1 First deploy
Make a change to the code and commit it, push that change to the repo, this will trigger a deploy, we will see that the code folder does not exist, it will be created on the first GIT CLONE

make change and commit. e.g. update the version number make VERSION=x.y.z bump-version
note: the difference between first & subsequent is seen on the server side. On first commit the deploy handler, if the folder does not exist will CLONE the repo

# 2.5.2.2 Deploy via Commit - subsequent deploy
Make a change to the code and commit it, push that change to the repo, this will trigger a deploy,

make change and commit. e.g. update the version number make VERSION=x.y.z bump-version
note: the difference between first & subsequent is seen on the server side. On subsequent commit the deploy handler, if the folder does exist will PULL the repo

## 3.Endpoints

Please find the below endpoints in detail describing their usage and the expected output

hello
health
metadata
index
###:: hello
Just to say, Hello World

Endpoint-url:: http://Deevya.com/staging/Deevya-devops/api/hello.php

### Result

{
   "statusCode": 200,
      "endpoint": "http://Deevya.com/staging/Deevya-devops/api/hello.php",
        "message": "Hello World"
             }

note: the result will be JSON encoded, the above has been decoded for textual clarity

### :: health
To tell us the system is up and running, and return some usful statistics, e.g. Disk Space free, Kernel version 

Endpoint-url: http://Deevya.com/staging/Deevya-devops/api/health.php 

### Result

{
  "statusCode": 200,
    -"endpoint": "http://Deevya.com/staging/Deevya-devops/api/health.php",
      - "result": {
          -"status": "OK",
              -"checksum": "d41d8cd98f00b204e9800998ecf8427e"
                    }
                          }
note: the result will be JSON encoded, the above has been decoded for textual clarity

### :: metadata
Get some interesting information from the system. e.g. Code Commits, and last commit

Endpoint-url: http://Deevya.com/staging/Deevya-devops/api/metadata.php

### result

{
  "statusCode": 200,
  "endpoint": "http://Deevya.com/staging/Deevya-devops/api/metadata.php",
  "myapplication": {
    "version": "1.5a",
    "description": "technical test",
    "lastcommitsha": "81a52fd",
    "commitLog": [
    ]
  }
}
note: the result will be JSON encoded, the above has been decoded for textual clarity

### 3.4 index
Discover what enpoints are available

Endpoint-url:: http://Deevya.com/Deevya-devops/api

{
  "statusCode": 200,
  "endpoint": "http://localhost/index1.php",
  "authors": {
    "Deevya": {
      "linkedin": "https://www.linkedin.com/in/deevya-naresh-kumar/",
      "github": "https://github.com/DeevyaNaresh/Deevya-Myob-Devops"
    }
  },
  "code-inspection": {
    "travis": "https://travis-ci.org/DeevyaNaresh/Deevya-Myob-Devops",
    "github": "https://github.com/DeevyaNaresh/Deevya-Myob-Devops"
  },
  "endpoints": [
    "http://localhost/app.php",
    "http://localhost/health.php",
    "http://localhost/hello.php",
    "http://localhost/metadata.php"
  ]
}

# 4. Integration tests

Test are written with PHPUnit and executed via commandline or https://travis-ci.org/DeevyaNaresh/Deevya-Myob-Devops/ I have made use of the PHPUnit framework to execute tests against the remote endpoints, as this is well supported by Travis CI and other pipeline tools. This approach will hopfully make it easier for developers to contibute to the testing.


Travis CI

4.1. Via Travis
You can view the output of tests at Travis - Deevya-Myob-Devops

# 5.0 Help

The Makefile has a help target. using the '# @make ' annotations within the file we are able to construct a code driven help

make help

Result

usage:

 make help
 .... what does this Makefile do?

 make readme
 .... view readme file

 make clean
 .... remove old build components

 make configure
 .... setup, download required components

 make tests
 .... Test code and endpoints

 etc, etc, etc,  
 
 

