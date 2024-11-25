<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

// Initialize $results as an empty array 
$results = [];

if (isset($_GET['country'])) { 
  $country = $_GET['country']; 
  // Check for lookup query and if it is set to cities
  if (isset($_GET['lookup']) && $_GET['lookup'] == 'cities') {
    // Creates a table that includes all cities that match the country entered in the search bar.
    $stmt = $conn->prepare("SELECT cities.name AS city_name, cities.district, cities.population 
                            FROM cities 
                            JOIN countries ON cities.country_code = countries.code 
                            WHERE countries.name LIKE :country"); 
    $stmt->execute(['country' => "%$country%"]);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
  else{
    // Creates a table that includes all countries that match the country entered in the search bar.
    $stmt = $conn->prepare("SELECT name, continent, independence_year, head_of_state 
                            FROM countries 
                            WHERE name LIKE :country");
    $stmt->execute(['country' => "%$country%"]); 
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
} 
else { 
  // Selects all countries
  $stmt = $conn->query("SELECT name, continent, independence_year, head_of_state FROM countries");
  $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html> 
<html lang="en">
  <body> 
    <table> 
      <thead> 
        <tr> 
        <?php if (isset($_GET['lookup']) && $_GET['lookup'] == 'cities'): ?> 
          <th>City Name</th> 
          <th>District</th> 
          <th>Population</th> 
        <?php else: ?> 
          <th>Country Name</th> 
          <th>Continent</th> 
          <th>Independence Year</th> 
          <th>Head of State</th> 
        <?php endif; ?>
        </tr> 
      </thead> 
        
      <tbody> 
        <?php foreach ($results as $row): ?> 
          <tr> 
          <?php if (isset($_GET['lookup']) && $_GET['lookup'] == 'cities'): ?> 
            <td><?= $row['city_name']; ?></td> 
            <td><?= $row['district']; ?></td> 
            <td><?= $row['population']; ?></td> 
          <?php else: ?> 
            <td><?= $row['name']; ?></td> 
            <td><?= $row['continent']; ?></td> 
            <td><?= $row['independence_year']; ?></td> 
            <td><?= $row['head_of_state']; ?></td> 
          <?php endif; ?> 
          </tr> 
        <?php endforeach; ?> 
      </tbody> 
    </table> 
  </body> 
</html>