# Book library task
A test Symfony project for Kurzor.
Assignment described below.

We would like to handle a simple library of books. We would like to:

## 1. List all the books we have
Will create a simple list of book information. The best way is to utilize some data grid. We will need pagination, no need of filtering, sorting or entries per page selection. List will contain information:

`title`, `author`, book `description` limited to 200 characters if it is longer than that, `date and time` when entry was added.

## 2. We would like to add and edit book information
So create 2 actions: one to **add** and one to **edit** the book information

Each book has title, author, book description and date time entry was added (this one is set automatically when book is created).

We need to have form **validation** like this:

+ `title` - required information, string at least 3 characters, at most 127
+ `author` - required information, string at least 1 characters, at most 127
+ `description` - textarea (pure text - not HTML) not required information, at most 1000 characters

## 3. Database schema will be in separate SQL file together with some test data.
If framework supports migrations or some other way of dealing with SQL schema or sample data use this approach

## 4. Create README file
Describe the steps programmer need to do to run test project


If you want to use some ORM like Doctrine feel free to use it. If you prefer to use some other db layer feel free to use it also.
