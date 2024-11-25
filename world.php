<?php
$host = 'localhost';
$username = 'lab5_user';
$password = '';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

if (isset($_GET['country'])) { 
  $country = $_GET['country']; 
  // Creates a table that includes all countries that match the country entered in the search bar.
  $stmt = $conn->prepare("SELECT name, continent, independence_year, head_of_state FROM countries WHERE name LIKE :country");
  $stmt->execute(['country' => "%$country%"]); 
} 
else 
{ 
  // Selects all countries
  $stmt = $conn->query("SELECT name, continent, independence_year, head_of_state FROM countries");
}

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html> 
<html lang="en">
  <body> 
    <table> 
      <thead> 
        <tr> 
          <th>Country Name</th> 
          <th>Continent</th> 
          <th>Independence Year</th> 
          <th>Head of State</th> 
        </tr> 
      </thead> 
        
      <tbody> 
        <?php foreach ($results as $row): ?> 
          <tr> 
            <td><?= $row['name']; ?></td> 
            <td><?= $row['continent']; ?></td> 
            <td><?= $row['independence_year']; ?></td>
            <td><?= $row['head_of_state']; ?></td> 
          </tr> 
        <?php endforeach; ?> 
      </tbody> 
    </table> 
  </body> 
</html>