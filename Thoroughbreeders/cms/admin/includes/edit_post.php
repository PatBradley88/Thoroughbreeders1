<?php 

if(isset($_GET['p_id'])) {
    
 $the_post_id = $_GET['p_id']; 
    
}


$query = "SELECT * FROM posts WHERE post_id = $the_post_id";
$select_posts_by_id = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($select_posts_by_id)) {
            $post_id = $row['post_id'];
            $post_stud_id = $row['post_stud_id'];
            $post_title = $row['post_title'];
            $post_category_id = $row['post_category_id'];
            $post_status = $row['post_status'];
            $post_image = $row['post_image'];
            $post_content = $row['post_content'];
            $post_tags = $row['post_tags'];
            $post_comment_count = $row['post_comment_count'];
            $post_date = $row['post_date'];
        
        
    }

    if(isset($_POST['update_post'])) {
        
        $post_stud_id = $_POST['post_stud'];
        $post_title = $_POST['title'];
        $post_category_id = $_POST['post_category'];
        $post_status = $_POST['post_status'];
        
        $post_image = $_FILES['image']['name'];
        $post_image_temp = $_FILES['image']['tmp_name'];
        
        $post_content = $_POST['post_content'];
        $post_tags = $_POST['post_tags'];
        

move_uploaded_file($post_image_temp, "../images/$post_image");
        
        $post_title = mysqli_real_escape_string($connection, $post_title);
        
        $post_content = mysqli_real_escape_string($connection, $post_content);
        
        $post_tags = mysqli_real_escape_string($connection, $post_tags);
        
        if(empty($post_image)) {
            
            $query = "SELECT * FROM posts WHERE post_id = $the_post_id ";
            $select_image = mysqli_query($connection, $query);
            
            while($row = mysqli_fetch_array($select_image)) {
                
                $post_image = $row['post_image'];
                
            }
            
        }
        
        
        $query = "UPDATE posts SET ";
        $query .="post_title = '{$post_title}', ";
        $query .="post_category_id = '{$post_category_id}', ";
        $query .="post_date = now(), ";
        $query .="post_stud_id = '{$post_stud_id}', ";
        $query .="post_status = '{$post_status}', ";
        $query .="post_tags = '{$post_tags}', ";
        $query .="post_content = '{$post_content}', ";
        $query .="post_image = '{$post_image}' ";
        $query .="WHERE post_id = {$the_post_id} ";

        $update_post = mysqli_query($connection, $query);
        
        confirmQuery($update_post);
        
        echo "Post Updated: " . " " . "<a href='posts.php'>Return to View All Posts</a>";
        
    }

?>
   
   <form action="" method="post" enctype="multipart/form-data">
    
    
    <div class="form-group">
        <label for="title">Horse Name</label>
        <input value="<?php echo $post_title; ?>" type="text" class="form-control" name="title">
    </div>
    
    <div class="form-group">
       <label for="post_category">Sex</label>
        <select name="post_category" id="">
            <?php 
            $query = "SELECT * FROM categories";
                $select_categories = mysqli_query($connection, $query);
            
                confirmQuery($select_categories);

                while($row = mysqli_fetch_assoc($select_categories)) {
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];
                
            
                echo "<option value='{$cat_id}'>{$cat_title}</option>";
                }
            ?>
        </select>
    </div>
    
     <div class="form-group">
       <label for="post_stud">Stud</label>
        <select name="post_stud" id="">           
            <?php 
            $query = "SELECT * FROM Studs";
                $select_studs = mysqli_query($connection, $query);
            
                confirmQuery($select_studs);

                while($row = mysqli_fetch_assoc($select_studs)) {
                $stud_id = $row['stud_id'];
                $stud_name = $row['stud_name'];
                
            
                echo "<option value='{$stud_id}'>{$stud_name}</option>";
                }
            ?>
        </select>
    </div>
    
<!--
    <div class="form-group">
        <label for="stud">Stud</label>
        <input value="<?php echo $post_stud_id; ?>" type="text" class="form-control" name="stud">
    </div>
-->
    
<!--
    <div class="form-group">
        <label for="post_status">Post Status</label>
        <input value="<?php echo $post_status; ?>" type="text" class="form-control" name="post_status">
    </div>
-->
    
    <div class="form-group" name="status">
       <label for="post_status">Post Status</label>
        <select name="post_status" id="">
           <option value="draft"><?php echo $post_status; ?></option>
            <?php 
            if ($post_status == 'draft') {
                
                echo "<option 
                value='published'>Publish</option>";
            
            } else {
                
                echo "<option value='draft'>Draft</option>";
            
            }
    
            ?>
        </select>
    </div>
    
    <div class="form-group">
        <img width="100" src="../images/<?php echo $post_image; ?>" alt="">
        <input type="file" name="image">
    </div>
    
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input value="<?php echo $post_tags; ?>" type="text" class="form-control" name="post_tags">
    </div>
    
    <div>
        <label for="post_content">Post Content</label>
        <textarea class="form-control" name="post_content" id="body" cols="30" rows="10">
        <?php echo $post_content; ?>
        </textarea>
    </div>
    
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update_post" value="Update Post">
    </div>
    
</form>