<?php 

    if(isset($_POST['create_post'])) {
        
        $post_title = $_POST['title'];
        $post_stud_id = $_POST['post_stud'];
        $post_category_id = $_POST['post_category'];
        $post_status = $_POST['post_status'];
        
        $post_image = $_FILES['image']['name'];
        $post_image_temp = $_FILES['image']['tmp_name'];
        
        $post_tags = $_POST['post_tags'];
        $post_content = $_POST['post_content'];
        $post_date = date('d-m-y');
        
        
        move_uploaded_file($post_image_temp, "../images/$post_image");
        
        $post_title = mysqli_real_escape_string($connection, $post_title);
        
        $post_content = mysqli_real_escape_string($connection, $post_content);
        
        $post_tags = mysqli_real_escape_string($connection, $post_tags);

        
        $query = "INSERT INTO posts(post_category_id, post_title, post_stud_id, post_date, post_image, post_content, post_tags, post_status)";
        
        
        $query .= "VALUES({$post_category_id},'{$post_title}','{$post_stud_id}',now(), '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_status}')";
        
        $create_post_query = mysqli_query($connection, $query);
        
        confirmQuery($create_post_query);
           
        echo "New post created and sent for approval: " . " " . "<a href='posts.php'>Return to View All Posts</a>";
    }



?>
   

   
   
   
   
   <form action="" method="post" enctype="multipart/form-data">
    
    
    <div class="form-group">
        <label for="title">Horse Name</label>
        <input type="text" class="form-control" name="title">
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
        <input type="text" class="form-control" name="stud">
    </div>
-->
    
<!--
    <div class="form-group">
        <label for="post_status">Post Status</label>
        <input type="text" class="form-control" name="post_status">
    </div>
-->
    
    <div class="form-group" name="status">
       <label for="post_status">Post Status</label>
        <select name="post_status" id="">
           <option value="draft">Select Options</option>
           <option value="draft">Draft</option>
           <option value="published">Publish</option>
        </select>
    </div>
    
    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name="image">
    </div>
    
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags">
    </div>
    
    <div>
        <label for="post_content">Post Content</label>
        <textarea class="form-control" name="post_content" id="body" cols="30" rows="10"></textarea>
    </div>
    
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_post" value="Publish Post">
    </div>
    
</form>




