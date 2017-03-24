# mysql-agent
This is a project implementing the Strategy Design Pattern to enable faster interaction with a mysql database, when executing simple CRUD queries. 

Found the need to built this tool when, as students, we needed to interact with a huge database for a Java project back in 2010. I've since switched over to web development and translated it into php.

## Installation

None need, just copy this folder into your lib / vendor directory, or wherever you see fit :D.

## Requirements and Assumptions
These classes depend on your database following this convention:
- every table has an `_id` field as it's first field which has the data type int and named like: `{table_name}_id`, so if you have a table called `taxi`, the first field in that table should be `taxi_id`
- the last field in every table has a boolean field named `hide` with a default value of `0`. This makes sure that, by default we always soft delete records.
- of course all the `id` fields are used as primary keys and auto increment should be on by default.

Note: I am planning on making the base class configurable, but it isn't for now, so you'll have to set your database details in the base class manually. See `connector/connect.php`

## Usage

Depending on which query you're going to run, you'll construct an object of the same class ie: Delete, Insert, Update or HideRecord

## Contributing

This is not really for public consumption yet, though you can use it (at your own risk) hahaha. 

## Plans
I am planning on simplifying usage of this library so only one object needs to be used ie: the `DatabaseAccessor` class, which: if you take a proper look at it, you'll see it's still incomplete.

I'm also thinking of a way to implement complex queries, using indexes for scalability etc. Please share any ideas and you'll be able to fork soon :D
