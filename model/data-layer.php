<?php

/**
 * @author Anthony Gutierrez
 * @auther Mehdi Jokar
 *
 * Created 6/3/2023
 * 328/secondhand-books/model/data-layer.php
 * The DataLayer class for Sleeping Donuts project
 */


require_once($_SERVER['DOCUMENT_ROOT'].'/../pdo.php');
class DataLayer
{

    /**
     * @var PDO The database connection object
     */
    private $_dbh;

    /**
     * DataLayer Constructor
     */
    function __construct()
    {
        try{
            //Instantiate a database object
            $this->_dbh = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
            //echo "Connected to database!";
        }
        catch(PDOException $e){
            echo $e->getMessage();

        }
    }


    /**
     * insertPerson insert a new person from the secondhand-books app
     * @param Person A Person object
     * @return person_id of the new person object
     */
    function insertPerson($person)
    {
        //PDO - Using Prepared Statements
        //1. Define the query (test first!)
        $sql = "INSERT INTO Person (first_name, last_name, phone, address, email, password, uuid)
            VALUES (:first_name, :last_name, :phone, :address, :email, :password, uuid())";

        //2. Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //3. Bind the parameters
        $first_name = $person->getFname();
        $last_name = $person->getLname();
        $phone = $person->getPhone();
        $address = $person->getAddress();
        $email = $person->getEmail();
        // Hash the password
        $password = password_hash($person->getPassword(), PASSWORD_DEFAULT);

        $statement->bindParam(':first_name', $first_name);
        $statement->bindParam(':last_name', $last_name);
        $statement->bindParam(':phone', $phone);
        $statement->bindParam(':address', $address);
        $statement->bindParam(':email', $email);
        $statement->bindParam(':password', $password);


        //4. Execute
        $statement->execute();

        //5. Process the result, if there is one
        $id = $this->_dbh->lastInsertId();
        return $id;
    }



    /**
     * updatePerson update a person from the secondhand-books app
     * @param Person A Person object
     * @return person_id of the new person object
     */
    function updatePerson($person)
    {
        // Prepare the SQL statement
        $sql = "UPDATE Person SET first_name = :first_name, last_name = :last_name,
        phone = :phone, address = :address, email = :email
        WHERE person_id = :person_id";

        //2. Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //3. Bind the parameters
        $first_name = $person->getFname();
        $last_name = $person->getLname();
        $phone = $person->getPhone();
        $address = $person->getAddress();
        $email = $person->getEmail();
        $id = $person->getPersonId();


        $statement->bindParam(':first_name', $first_name);
        $statement->bindParam(':last_name', $last_name);
        $statement->bindParam(':phone', $phone);
        $statement->bindParam(':address', $address);
        $statement->bindParam(':email', $email);
        $statement->bindParam(':person_id', $id);


        //4. Execute
        $statement->execute();

        return $id;
    }


    /**
     * This function returns a user or an admin
     * based on person's is_admin column
     * @param $person_id
     * @return Admin|User
     */
    function getPerson($person_id)
    {
        // 1. define the query
        $sql = "SELECT *
                FROM Person 
                WHERE person_id = :person_id";

        // 2. prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //3. bind the parameters
        $statement->bindParam(':person_id', $person_id);

        //4. Execute
        $statement->execute();

        // 5. Process the result
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        if($row['is_admin'] == 0){
            $person = new User($row['first_name'], $row['last_name'],
                $row['email'], $row['password'], $row['phone'], $row['address']);

        } else {
            $person = new Admin($row['first_name'], $row['last_name'],
                $row['email'], $row['password'], $row['phone'], $row['address']);
        }
        $person->setUuid($row['uuid']);
        return $person;
    }

    /**
     * This function active a person by uuid that
     * has sent to the user's email
     * @param $uuid
     * @return true if updated successfully
     */
    function confirmEmail($uuid)
    {

        // 1. define the query
        $sql = "UPDATE Person SET is_active = 1 WHERE uuid = :uuid";

        // 2. prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //3. bind the parameters

        $statement->bindParam(':uuid', $uuid);

        //4. Execute
        $statement->execute();

        return true;
    }


    /**
     * This function returns a user or an admin
     * based on person's is_admin column by email
     * @param $email
     * @return Admin|User
     */
    function getPersonByEmail($email)
    {
        // 1. define the query
        $sql = "SELECT *
                FROM Person 
                WHERE email = :email";

        // 2. prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //3. bind the parameters
        $statement->bindParam(':email', $email);

        //4. Execute
        $statement->execute();

        // 5. Process the result
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        if($row['is_admin'] == 0){
            $person = new User($row['first_name'], $row['last_name'],
                $row['email'], $row['password'], $row['phone'], $row['address']);

        } else {
            $person = new Admin($row['first_name'], $row['last_name'],
                $row['email'], $row['password'], $row['phone'], $row['address']);

        }
        $person->setPersonId($row['person_id']);
        return $person;
    }

    /**
     * insertBook insert a new book object
     * for the secondhand-books app
     * @param Book An Book object
     * @return book_id of the new book object
     */
    function insertBook($book)
    {
        //PDO - Using Prepared Statements
        //1. Define the query (test first!)
        $sql = "INSERT INTO Book (title, owner , authors, edition, description, subject, photoPath, photo_name, price)
            VALUES (:title, :owner , :authors, :edition, :description, :subject, :photoPath, :photo_name, :price)";

        //2. Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //3. Bind the parameters
        $title = $book->getTitle();
        $owner = $book->getOwner();
        $authors = $book->getAuthors();
        $edition = $book->getEdition();
        $description = $book->getDescription();
        $subject = $book->getSubject();
        $photo_path = $book->getPhotoPath();
        $photo_name = $book->getPhotoName();
        $price = $book->getPrice();


        $statement->bindParam(':title', $title);
        $statement->bindParam(':owner', $owner);
        $statement->bindParam(':authors', $authors);
        $statement->bindParam(':edition', $edition);
        $statement->bindParam(':description', $description);
        $statement->bindParam(':subject', $subject);
        $statement->bindParam(':photoPath', $photo_path);
        $statement->bindParam(':photo_name', $photo_name);
        $statement->bindParam(':price', $price);



        //4. Execute
        $statement->execute();

        //5. Process the result, if there is one
        $id = $this->_dbh->lastInsertId();
        return $id;
    }


    /**
     * updateBook update a book
     * for the secondhand-books app
     * @param Book An Book object
     * @return book_id of the book object
     */
    function updateBook($book)
    {
        //PDO - Using Prepared Statements
        //1. Define the query (test first!)
        $sql = "UPDATE Book SET
            title = :title,
            authors = :authors,
            edition = :edition,
            description = :description,
            subject = :subject,
            price = :price
        WHERE book_id = :book_id";

        //2. Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //3. Bind the parameters
        $title = $book->getTitle();
        $authors = $book->getAuthors();
        $edition = $book->getEdition();
        $description = $book->getDescription();
        $subject = $book->getSubject();
        $book_id = $book->getBookId();
        $price = $book->getPrice();


        $statement->bindParam(':title', $title);
        $statement->bindParam(':authors', $authors);
        $statement->bindParam(':edition', $edition);
        $statement->bindParam(':description', $description);
        $statement->bindParam(':subject', $subject);
        $statement->bindParam(':book_id', $book_id);
        $statement->bindParam(':price', $price);



        //4. Execute
        $statement->execute();


        return $book_id;
    }

    /**
     * This function returns a book
     * based on book_id
     * @param $book_id
     * @return Book object
     */
    function getBook($book_id)
    {
        // 1. define the query
        $sql = "SELECT *
                FROM Book 
                WHERE book_id = :book_id";

        // 2. prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //3. bind the parameters
        $statement->bindParam(':book_id', $book_id);

        //4. Execute
        $statement->execute();

        // 5. Process the result
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        $book = new Book($row['title'], $row['owner'], $row['authors'],
            $row['price'], $row['photoPath'], $row['photo_name'], $row['description'], $row['subject'], $row['edition']);
        $book->setIsApproved($row['isApproved']);
        $book->setBookId($row['book_id']);

        return $book;
    }

    function search($search_phrase){

        // SELECT Statement - multiple rows
        // 1. define the query
        $sql = "SELECT * FROM Book
                    WHERE isApproved = 1
                        AND (title LIKE :keyword
                        OR authors LIKE :keyword
                        OR subject LIKE :keyword
                        OR description LIKE :keyword)";

        // 2. prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //3. bind the parameters
        $str = '%' . $search_phrase . '%';
        $statement->bindParam(':keyword', $str);


        //4. Execute
        $statement->execute();

        // 5. Process the result
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        $books = array();

        foreach ($result as $row){
            $book = new Book($row['title'], $row['owner'], $row['authors'],
                $row['price'], $row['photoPath'], $row['photo_name'], $row['description'], $row['subject'], $row['edition']);
            $book->setBookId($row['book_id']);
            $books[] = $book;
        }

        return $books;

    }

    function getUnapprovedBooks(){
        // SELECT Statement - multiple rows
        // 1. define the query
        $sql = "SELECT * FROM Book
                    WHERE isApproved = 0";

        // 2. prepare the statement
        $statement = $this->_dbh->prepare($sql);



        //4. Execute
        $statement->execute();

        // 5. Process the result
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        $books = array();

        foreach ($result as $row){
            $book = new Book($row['title'], $row['owner'], $row['authors'],
                $row['price'], $row['photoPath'], $row['photo_name'], $row['description'], $row['subject'], $row['edition']);
            $book->setBookId($row['book_id']);
            $books[] = $book;
        }

        return $books;
    }

    function approveBook($book_id)
    {

        // 1. define the query
        $sql = "UPDATE Book SET isApproved = 1 WHERE book_id  = :book_id";

        // 2. prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //3. bind the parameters
        $statement->bindParam(':book_id', $book_id);

        //4. Execute
        $statement->execute();

        return true;
    }
    function getBooks()
    {
        // 1. define the query
        $sql = "SELECT * FROM Book WHERE isApproved = 1
                ORDER BY book_id;";

        // 2. prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //4. Execute
        $statement->execute();

        // 5. Process the result
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        $books = array();

        foreach ($result as $row){
            $book = new Book($row['title'],
                $row['owner'],
                $row['authors'],
                $row['price'],
                $row['photoPath'],
                $row['photo_name'],
                $row['description'],
                $row['subject'],
                $row['edition']);
            $book->setBookId($row['book_id']);
            $books[] = $book;
        }

        return $books;
    }

    function getBooksByOwner($personId)
    {
        // 1. define the query
        $sql = "SELECT * FROM Book WHERE owner = :owner";

        // 2. prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //3. bind the parameters
        $statement->bindParam(':owner', $personId);

        //4. Execute
        $statement->execute();

        // 5. Process the result
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        $books = array();

        foreach ($result as $row){
            $book = new Book($row['title'],
                $row['owner'],
                $row['authors'],
                $row['price'],
                $row['photoPath'],
                $row['photo_name'],
                $row['description'],
                $row['subject'],
                $row['edition']);
            $book->setBookId($row['book_id']);
            $book->setIsApproved($row['isApproved']);
            $books[] = $book;
        }

        return $books;
    }

    static function getSortingChoices()
    {
        return array("title", "authors", "subject", "price");
    }

    function sortBy($sortType)
    {
        // 1. Define the query
        $sql = "SELECT * FROM Book WHERE isApproved = 1
        ORDER BY " . $sortType;

        // 2. Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        // 3. Execute
        $statement->execute();

        // 5. Process the result
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        $books = array();

        foreach ($result as $row){
            $book = new Book($row['title'],
                $row['owner'],
                $row['authors'],
                $row['price'],
                $row['photoPath'],
                $row['photo_name'],
                $row['description'],
                $row['subject'],
                $row['edition']);
            $book->setBookId($row['book_id']);
            $books[] = $book;
        }

        return $books;
    }

    function deleteBook($book_id)
    {
        // 1. define the query
        $sql = "DELETE FROM Book WHERE book_id = :book_id;";

        // 2. prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //3. bind the parameters
        $statement->bindParam(':book_id', $book_id);

        //4. Execute
        $statement->execute();


        return $book_id;
    }


    function getOwnerEmail($owner_id)
    {
        // 1. define the query
        $sql = "SELECT email FROM Person WHERE person_id = :owner_id";

        // 2. prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //3. bind the parameters
        $statement->bindParam(':owner_id', $owner_id);

        //4. Execute
        $statement->execute();

        // 5. Process the result
        $row = $statement->fetch(PDO::FETCH_ASSOC);



        return $row['email'];
    }


    function passwordResetLink($email)
    {
        $currentDateTime = date("Y-m-d H:i:s");
        $futureDateTime = date("Y-m-d H:i:s", strtotime($currentDateTime . "+15 minutes"));

        // 1. define the query
        $sql = "UPDATE Person SET uuid = uuid(), password_timestamp = :time WHERE email = :email";

        // 2. prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //3. bind the parameters
        $statement->bindParam(':email', $email);
        $statement->bindParam(':time', $futureDateTime);

        //4. Execute
        $statement->execute();


        // 1. define the query
        $sql2 = "SELECT uuid FROM Person WHERE email = :email";

        // 2. prepare the statement
        $statement2 = $this->_dbh->prepare($sql2);

        //3. bind the parameters
        $statement2->bindParam(':email', $email);

        //4. Execute
        $statement2->execute();

        // 5. Process the result
        $row = $statement2->fetch(PDO::FETCH_ASSOC);


        return $row['uuid'];
    }




    function checkUuidExpirationTime($uuid)
    {
        // 1. define the query
        $sql = "SELECT password_timestamp FROM Person WHERE uuid = :uuid";

        // 2. prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //3. bind the parameters
        $statement->bindParam(':uuid', $uuid);

        //4. Execute
        $statement->execute();

        // 5. Process the result
        $row = $statement->fetch(PDO::FETCH_ASSOC);

        $password_timestamp = $row['password_timestamp'];
        $currentDateTime = date("Y-m-d H:i:s");

        if ($password_timestamp >= $currentDateTime){
            return true;
        } else {
            return false;
        }
    }


    function updatePassword($uuid, $password){

        // 1. define the query
        $sql = "UPDATE Person SET password = :password WHERE uuid = :uuid";

        // 2. prepare the statement
        $statement = $this->_dbh->prepare($sql);

        // Hash the password
        $password = password_hash($password, PASSWORD_DEFAULT);

        //3. bind the parameters
        $statement->bindParam(':password', $password);
        $statement->bindParam(':uuid', $uuid);

        //4. Execute
        $statement->execute();

        return true;
    }




}