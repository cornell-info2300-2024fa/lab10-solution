<?php
/* Note: No credit is provided for submitting design and/or code that is     */
/*       taken from course-provided examples.                                */
/*                                                                           */
/* Do not copy this code into your project submission and then change it.    */
/*                                                                           */
/* Write your own code from scratch. Use this example as a REFERENCE only.   */
/*                                                                           */
/* You may not copy this code, change a few names/variables, and then claim  */
/* it as your own.                                                           */
/*                                                                           */
/* Examples are provided to help you learn. Copying the example and then     */
/* changing it a bit, does not help you learn the learning objectives of     */
/* this assignment. You need to write your own code from scratch to help you */
/* learn.                                                                    */

$page_title = "Product Reviews";

$nav_reviews_class = "active_page";

const RATING_STARS = array(
  1 => "★☆☆☆☆",
  2 => "★★☆☆☆",
  3 => "★★★☆☆",
  4 => "★★★★☆",
  5 => "★★★★★"
);

// retrieve query string parameters for sort
$sort_param = "TODO: retrieve sort query string parameter";

// CSS classes for sort arrows
$sort_css_classes = array(
  "new" => "",
  "old" => "",
  "high" => "",
  "low" => "",
);

// The SQL query parts
$sql_select_clause = "SELECT products.name AS 'products.name', reviews.rating AS 'reviews.rating', reviews.comment AS 'reviews.comment'
FROM reviews INNER JOIN products ON (reviews.product_id = products.id)";
$sql_order_clause = "TODO: default order clause - no order"; // No order by default

// sort if query string param is new, old, high, or low
if (in_array($sort_param, array("new", "old", "high", "low"))) {
  $sort_css_classes[$sort_param] = "active";

  if ($sort_param == "new") {
    $sql_sort_field = "TODO: sort by created_at field";
    $sql_sort_order = "TODO: sort in descending order";
  } else if ($sort_param == "old") {
    $sql_sort_field = "TODO: sort by created_at field";
    $sql_sort_order = "TODO: sort in ascending order";
  } else if ($sort_param == "high") {
    $sql_sort_field = "TODO: sort by rating field";
    $sql_sort_order = "TODO: sort in descending order";
  } else if ($sort_param == "low") {
    $sql_sort_field = "TODO: sort by rating field";
    $sql_sort_order = "TODO: sort in ascending order";
  }

  $sql_order_clause = "TODO: concatenate order clause with sort field and order";
}

// glue select clause to order clause
$sql_select_query = $sql_select_clause . ";";

// query DB
$records = exec_sql_query($db, $sql_select_query)->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">

<?php include "includes/meta.php" ?>

<body>
  <?php include "includes/header.php" ?>

  <main class="reviews">
    <h2><?php echo $page_title; ?></h2>

    <div class="sort">
      Sort by:
      <a class="<?php echo $sort_css_classes["new"]; ?>" href="TODO: URL with query string to sort by newest reviews">Newest</a>
      |
      <a class="<?php echo $sort_css_classes["old"]; ?>" href="TODO: URL with query string to sort by oldest reviews">Oldest</a>
      |
      <a class="<?php echo $sort_css_classes["high"]; ?>" href="TODO: URL with query string to sort by highest rated reviews">Best Rated</a>
      |
      <a class="<?php echo $sort_css_classes["low"]; ?>" href="TODO: URL with query string to sort by lowest rated reviews">Lowest Rated</a>
    </div>

    <ul>
      <?php
      // create a review tile for each record
      foreach ($records as $record) {
        $name = $record["products.name"];
        $rating = RATING_STARS[$record["reviews.rating"]];
        $comment = $record["reviews.comment"];

        // tile partial
        include "includes/review-tile.php";
      } ?>
    </ul>

  </main>

  <?php include "includes/footer.php" ?>
</body>

</html>
