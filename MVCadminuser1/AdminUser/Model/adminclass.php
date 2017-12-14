<?php
include("person.php");

class Admin extends Person {

    public function disableUser($uid) {
        $dbClass = new DBcontroller();
    	$delete_users_query = "UPDATE usersInformation set status=0 where uid=".$uid."";
    
        if($dbClass->runQry($delete_users_query))
        {
            echo "disabled succesfully";

        }
        else
        {
            echo "error while disbeling data ";
        }

    }
    public function enableUser($uid) {
        $dbClass = new DBcontroller();
        $delete_users_query = "UPDATE usersInformation set status=1 where uid=".$uid."";
    
        if($dbClass->runQry($delete_users_query))
        {
            echo "enabled succesfully";

        }
        else
        {
            echo "error while enabeling data ";
        }

    }
    public function deleteUser($uid) {
        $dbClass = new DBcontroller();
        $delete_users_query = "DELETE from usersInformation where uid=".$uid."";
    
        if($dbClass->runQry($delete_users_query))
        {
            echo "deleted succesfully";

        }
        else
        {
            echo "error while deleting data ";
        }

    }
    
    public function getAllUsers() {
        $arr=array();
        $dbClass = new DBcontroller();
        $qry="select username,email,contact from usersInformation where role_id=2";
        $result=$dbClass->runQry($qry);
      
        while($rows = mysqli_fetch_array($result)) {
          $arr[] = array($rows['username'],$rows['email'],$rows['contact']);
        }
        return $arr;
    }
    public function getUsers() {
        $arr=array();
        $dbClass = new DBcontroller();
        $qry="select uid,username,email,contact,status from usersInformation where role_id=2";
        $result=$dbClass->runQry($qry);
      
       /* while($rows = mysqli_fetch_array($result)) {
          $arr[] = array($rows['username'],$rows['email'],$rows['contact']);
        }*/
        return $result;
    }
    public function getUserByname($uname) {

        $dbClass = new DBcontroller();
        $qry="select uid from usersInformation where username='".$uname."'";

        $result=$dbClass->runQry($qry);
      
        while($rows = mysqli_fetch_array($result)) {
          $userid = $rows['uid'];
        }
       
        return $userid;
    }
     
     public function checkPassword($password)
    {
        
         $dbClass = new DBcontroller();
         $qry="select password from usersInformation where password='".$password."'";
         
         $result=$dbClass->runQry($qry);
      
         $rows = mysqli_fetch_array($result);
           
         if(!empty($rows['password']))
         {
            
            return true;
         }
         
        return false;
    }
    public function changePassword($uid,$password)
    {
         $dbClass = new DBcontroller();
         $query = "UPDATE usersInformation set password='$password' where uid=".$uid."";
        
         if($result=$dbClass->runQry($query))
         {
            return true;
         }
         
        return false;
    }


}
?>