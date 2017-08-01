<div id="search_area" class="col_12 column">
    <form class="horizontal" method="post" action="<?php echo $this->webroot; ?>jobs/browse">
        <input name="keywords" id="keywords" type="text" placeholder="Enter Keywords..." />
        <select name="state" id="state_select">
            <option>select state</option>
            <option value="AL">Alabama</option>
            <option value="AR">Arkansas</option>
            <option value="AZ">Arizona</option>
            <option value="CA">California</option>
            <option value="CO">Colorado</option>
            <option value="BA">Baston</option>
            <option value="GA">Georgia</option>
            <option value="ID">Idaho</option>
            <option value="IA">Iowa</option>
        </select>
        <select name="category" id="category_select">
            <option>select category</option>
            <?php foreach($categories as $category) :?>
              <option value="<?php echo $category['Category']['id']; ?>"><?php echo $category['Category']['name']; ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Submit</button>
    </form>
</div>
