# README 
[![Build Status](https://travis-ci.org/jgimeno/taskreporter.svg?branch=master)](https://travis-ci.org/jgimeno/taskreporter)
[![Coverage Status](https://coveralls.io/repos/jgimeno/taskreporter/badge.svg?branch=master&service=github)](https://coveralls.io/github/jgimeno/taskreporter?branch=master)

## TaskReporter (DDD)

### Objective of this project

In my job my boss requieres that every day when we finish we send an Email
to him and to our manager with a list of tasks we did that day. 

It was really boring at the end of the journey to open my email client and remember all that I
did. So it was a nice excuse to create a tiny command line app in PHP following a
**Domain Driven Design** approach.

I started with a code first approach so if you see 
no framework at all it's because I still did not decide if I will need one!

Don't you think is a good idea to start developing since the beginning and
 not being coupled to any framework? :D

### Usage

Once you clone the repo execute doctrine command to create sqlite internal database:

```
vendor/bin/doctrine orm:schema-tool:update --force
```

Then you can start playing with the commands:

#### Add a new task

You can a dd a new task with the command.

```
php console.php taskReporter:add "New task."
```

If you have a task with a ticket id you can add it like this:

```
php console.php taskReporter:add "#123# The task"
```

#### Listing the tasks

You can list inserted tasks with:

```
php console.php taskReporter:list
```

###TODO

Still we cannot send the report by mail :D