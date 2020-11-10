<?php
include('../../controller/UserController.php');
include_once('../../controller/Configuration.php');
class Template
{
   function getInterestList($user)
    {
        $interestList = $this->getInterestListIds($user);
        $userController = new UserController();
        $intersetListDesc = $userController->getInterestListDesc($interestList);
        
        return $intersetListDesc;
    }

    function getInterestListIds($user){
        $userController = new UserController();
        $interestList = $userController->getInterestList($user);
        $listArray = explode(',', $interestList);
        return $listArray;
    }

    function getSubjects($userId){
        $arryList = array();
        $config = new Configuration();  
        $subjects = $config->getSubjects();

        $interstList = $this->getInterestListIds($userId);

        foreach($subjects as $subject){
             
            $found = false;
            foreach($interstList as $interest){
                if($subject['subject_code']==$interest){
                    $found = true;
                }
            }
            if($found == false){
                array_push($arryList, $subject);
            }
        }
        return $arryList;
    }

    function addSubjects($user){
        $config = new Configuration();  

        $interestList = $this->getInterestListIds($user);
        $config->updateSubjects($user, implode(",",$interestList).",".implode(",",$_POST['addSubjcts']));
        
    }
}
?>