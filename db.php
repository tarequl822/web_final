<?php
    $conn = new mysqli("localhost", "root", "", "tourism", 3306);
    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

    //que1
    $sql1 = "SELECT SpotName, Region, Rating
From tourist_spot
WHERE Rating > 4.5 OR SpotName LIKE '%Beach%'
ORDER BY Rating DESC";

    $res = $conn->query($sql1);
    while($row = $res->fetch_assoc()){
        echo $row["SpotName"]." " ;
        echo $row["Region"]." ";
        echo $row["Rating"]. "<br>";
    }
    

    //que3
    $sql3 = "SELECT Category, COUNT(SpotID), AVG(Rating), SUM(VisitorsPerYear)
FROM tourist_spot
GROUP BY Category
HAVING AVG(Rating) >4.4
ORDER BY AVG(Rating) DESC";

    $res = $conn->query($sql3);
    while($row = $res->fetch_assoc()){
        echo $row["Category"]." " ;
        echo $row["COUNT(SpotID)"]." ";
        echo $row["AVG(Rating)"]. " ";
        echo $row["SUM(VisitorsPerYear)"]."<br>";
    }

    //que2
    $sql2 = "UPDATE tourist_spot
SET Rating = Rating+0.2 , EntryFee = EntryFee*1.1
WHERE Rating >= 4.0 AND Rating <=4.5 AND EntryFee>0";

    $res = $conn->query($sql2);
    echo "updated<br>";

// SELECT Category, AVG(Rating) AS AverageRating
// FROM TouristSpot
// WHERE EntryFee >= 0
// GROUP BY Category
// HAVING AVG(Rating) > 4.3
// ORDER BY AverageRating DESC
// LIMIT 2;


// -- 81. Find pairs of different spots in the same region
// SELECT A.SpotName AS SpotOne,
//        B.SpotName AS SpotTwo,
//        A.Region
// FROM TouristSpot AS A
// JOIN TouristSpot AS B
//   ON A.Region = B.Region
//  AND A.SpotID < B.SpotID;

//  -- 50. Update using a range
// UPDATE TouristSpot
// SET Rating = 4.5
// WHERE Rating BETWEEN 4.0 AND 4.3;

// - 42. Insert multiple rows
// INSERT INTO TouristSpot
// (SpotID, SpotName, Region, Category, Rating, EntryFee, VisitorsPerYear)
// VALUES
// (9, 'Example Beach A', 'CTG', 'Beach', 4.2, 20, 30000),
// (10, 'Example Forest B', 'SYL', 'Nature', 4.6, 60, 45000);
?>

/*
UPDATE tourist_spot
SET Rating = Rating + 0.2,
    EntryFee = EntryFee * 1.1
WHERE Rating >= 4.0 AND Rating <= 4.5
AND EntryFee > 0;
*/

SELECT Category, SUM(VisitorsPerYear) AS TotalVisitors
FROM tourist_spot
GROUP BY Category;


SELECT Category, COUNT(*) AS TotalSpots,
       AVG(Rating) AS AvgRating
FROM tourist_spot
GROUP BY Category
HAVING AVG(Rating) > 4.4
ORDER BY AVG(Rating) DESC;

SELECT Category,
       COUNT(*) AS TotalSpots,
       AVG(Rating) AS AvgRating,
       SUM(VisitorsPerYear) AS TotalVisitors
FROM tourist_spot
GROUP BY Category
HAVING AVG(Rating) > 4.4
ORDER BY AvgRating DESC;

SELECT Region, SUM(EntryFee * VisitorsPerYear) AS Revenue
FROM tourist_spot
GROUP BY Region
HAVING SUM(EntryFee * VisitorsPerYear) > 1000000
ORDER BY Revenue DESC;
