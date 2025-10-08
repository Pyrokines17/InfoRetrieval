<html>
<head>
    <title>ls10-5</title>
</head>
<body>
<?php

class Person {
     private $name;
     private $hobbies;

     public function __construct($name, $hobbies) {
          $this->name = $name;
          $this->hobbies = $hobbies;
     }

     public function tellAboutHobbies() {
          print "<p>Меня зовут $this->name и я предпочитаю";
          print "<ul>\n";

          foreach ($this->hobbies as $hobby) {
               print "<li>$hobby\n";
          }

          print "</ul>\n";
     }

     public function printReceivedData($data) {
          foreach ($data as $key=>$value) {
                    print "$key = $value<br>\n";
          }
     }
}

$user = $_POST["user"];
$hobby = $_POST["hobby"];
$someData = $_POST;

$nic = new Person($user, $hobby);
$nic->tellAboutHobbies();

$nic->printReceivedData($someData);
?>
</body>
</html>
