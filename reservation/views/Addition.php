<html>
   <head>
      <title>Easy Square</title>
   </head>
   <body>
      <?php if(isset($this->square)): ?>
         <p>The square of <?php echo $this->x; ?> is <?php echo $this->square; ?></p>
      <?php else: ?>
         <p>Please insert x!</p>
      <?php endif; ?>
   </body>
</html>