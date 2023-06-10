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
     * insertPerson inser a new person from the secondhand-books app
     * @param Person An Person object
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

    static function getBooks()
    {
        $books = array("book one", "book two", "book three", "book four");
        return $books;
    }


}