<?php

function get_entries($tag = null){
    include('connection.php');
    try{
        $sql = 'SELECT id, title, date, tag FROM entries INNER JOIN tags ON entries.tag_id = tags.tag_id';
        if (isset($tag)){
            $sql .= ' WHERE tag = ?';
        }
        $sql.= ' ORDER BY date DESC';
        $results = $db->prepare($sql);
        if (isset($tag)){
            $results->bindValue(1, $tag, PDO::PARAM_STR);
        }
        $results->execute();
        return $results;
    } catch (Exception $e){
        echo "Error retrieving data: ". $e->getMessage() . "</br>";
        return [];
    }
}

function get_tags(){
    include('connection.php');
    try{
        return $db->query('SELECT * FROM tags');
    } catch (Exception $e){
        echo "Error retrieving data: ". $e->getMessage() . "</br>";
        return [];
    }
}

function get_specific_entry($entry_id){
    include "connection.php";
    $sql = "SELECT title, date, time_spent, learned, resources, id, tag, tags.tag_id FROM entries INNER JOIN tags ON entries.tag_id = tags.tag_id WHERE id = ?";
    try{
        $results = $db->prepare($sql);
        $results->bindValue(1,$entry_id,PDO::PARAM_INT);
        $results->execute();
    } catch (Exception $e){
        echo "Error: " .$e->getMessage() . "<br /?";
        return false;
    }
    return $results->fetch();

}

function add_entry($title, $date, $time_spent, $learned, $resources, $tag){
    include('connection.php');
    $sql = 'INSERT INTO entries (title, date, time_spent, learned, resources, tag_id) VALUES (?, ?, ?, ?, ?, ?)';
    try{
        $results = $db->prepare($sql);
        $results->bindValue(1, $title, PDO::PARAM_STR);
        $results->bindValue(2, $date, PDO::PARAM_STR);
        $results->bindValue(3, $time_spent, PDO::PARAM_STR);
        $results->bindValue(4, $learned, PDO::PARAM_STR);
        $results->bindValue(5, $resources, PDO::PARAM_STR);
        $results->bindValue(6, $tag, PDO::PARAM_INT);
        $results->execute();
    } catch(Exception $e){
        echo "Error: " . $e->getMessage();
        return false;
    }
    return true;
}


function edit_entry($id, $title, $date, $time_spent, $learned, $resources, $tag){
    include('connection.php');
    $sql = 'UPDATE entries SET title = ?, date = ?, time_spent = ?, learned = ?, resources = ?, tag_id = ? WHERE id = ?';
    try{
        $results = $db->prepare($sql);
        $results->bindValue(1, $title, PDO::PARAM_STR);
        $results->bindValue(2, $date, PDO::PARAM_STR);
        $results->bindValue(3, $time_spent, PDO::PARAM_STR);
        $results->bindValue(4, $learned, PDO::PARAM_STR);
        $results->bindValue(5, $resources, PDO::PARAM_STR);
        $results->bindValue(6, $tag, PDO::PARAM_INT);
        $results->bindValue(7, $id, PDO::PARAM_INT);
        $results->execute();
    } catch(Exception $e){
        echo "Error: " . $e->getMessage();
        return false;
    }
    return true;
}

function delete_entry($entry_id){
    include "connection.php";
    $sql = "DELETE FROM entries WHERE id = ?";
    try{
        $results = $db->prepare($sql);
        $results->bindValue(1,$entry_id,PDO::PARAM_INT);
        $results->execute();
    } catch (Exception $e){
        echo "Error: " .$e->getMessage() . "<br /?";
        return false;
    }
    return true;

}