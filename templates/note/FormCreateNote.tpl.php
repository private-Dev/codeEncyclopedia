<?php  
Session_start();

if (!isset( $_SESSION['auth'])){
  header('Location: ../login.php');
  exit();
}
?>

<div class="container">
  <div class="row">
    <div class="col-sm">
     
    <div class="formulaire-note">
        <a href="" class="closeBtn"><i class="fa fa-times-circle iclose" aria-hidden="true"></i></a>
        <div class="form-group">
            <label for="beware" class="font-weight-bold">beware</label>
            <textarea id="beware" name="beware"  class="form-control"  rows="4" cols="50"></textarea>
        </div>

        <div class="form-group">
            <label for="big-title" class="font-weight-bold">Big title</label>
            <input type="text" class="form-control" name="big-title" id="big-title" aria-describedby="labelHelp">
        </div>

        <div class="form-group">
            <label for="Paragraph-title" class="font-weight-bold">Paragraph title</label>
            <input type="text" class="form-control" name="Paragraph-title" id="Paragraph-title" aria-describedby="labelHelp">
        </div>

        <div class="form-group">
            <label for="important-comment" class="font-weight-bold">important-comment</label>
            <textarea id="important-comment" name="important-comment"  class="form-control"  rows="4" cols="50"></textarea>
            
        </div>

        <div class="form-group">
            <label for="comment" class="font-weight-bold">comment</label>
            <textarea id="comment" name="comment"  class="form-control"  rows="4" cols="50"></textarea>
            
        </div>

        <div class="form-group">
            <label for="comment-bar" class="font-weight-bold">comment bar</label>
            <textarea id="comment-bar" name="comment-bar"  class="form-control"  rows="4" cols="50"></textarea>
        </div>

        <div class="form-group">
            <label for="code-block" class="font-weight-bold">code block</label>
            <textarea id="code-block" name="code-block"  class="form-control"  rows="4" cols="50"></textarea>
        
        </div>

        <div class="form-group">
            <label for="img-block" class="font-weight-bold">img block</label>
            <input type="text" class="form-control" name="img-block" id="img-block" aria-describedby="labelHelp">
        </div>

        <div class="form-group">
            <label for="hash-title" class="font-weight-bold">hash-title</label>
            <input type="text" class="form-control" name="hash-title" id="hash-title" aria-describedby="labelHelp">
            
            
        </div>

        <div class="form-group">
            <label for="tooltip" class="font-weight-bold">ToolTip message</label>
            <textarea id="tooltip" name="tooltip"  class="form-control"  rows="4" cols="50"></textarea>
        </div>
        <a  href="#" class ="btn btn-purpleCode  A-create-note" data-fkblocknote="<?php echo $_SESSION['selectedBlocknoteId'];?>">Créer</a> 
  </div>
    
    </div>
    <div class="col-sm wysiwyg">
      
      <div class="formulaire-note">
       
        <div class="form-group">
            <label for="beware" class="font-weight-bold">beware</label>
            <p class="tip warning"> Lorem ipsum dolor sit amet, consectetur adipisicing elit. </p>
           
        </div>

        <div class="form-group">
            <label for="big-title" class="font-weight-bold mt-4">Big title</label>
           <h1>Lorem ipsum dolor sit</h1>
        </div>

        <div class="form-group">
            <label for="Paragraph-title" class="font-weight-bold">Paragraph title</label>
            <h2 id="Basics"><a href="#Basics" class="headerlink" title="Basics" data-scroll="">Lorem</a></h2>
            
        </div>

        <div class="form-group">
            <label for="important-comment" class="font-weight-bold">important-comment</label>
            <p class="tip imp"> Lorem ipsum dolor sit amet, consectetur adipisicing elit. </p>
            
        </div>

        <div class="form-group">
            <label for="comment" class="font-weight-bold">comment</label>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque delectus repellat dolorem ipsum temporibus molestias dolor incidunt dolore quidem porro. At sunt placeat deleniti laudantium eius, dignissimos repudiandae temporibus minus.</p>
            
        </div>

        <div class="form-group">
            <label for="comment-bar" class="font-weight-bold mt-4">comment bar</label>
            <blockquote>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Alias accusantium hic dolore officiis nulla similique provident, excepturi saepe molestiae eos, maxime totam. Porro ad nihil repudiandae eos minus molestiae quod!</p>
            </blockquote>
        </div>

        <div class="form-group">
            <label for="code-block" class="font-weight-bold mt-1">code block</label>
            <pre>
                <code class="hljs js">
                    <span class="hljs-keyword">new</span> Vue({
                    <span class="hljs-attr">el</span>: <span class="hljs-string">'#app'</span>,
                    <span class="hljs-attr">router</span>: router,
                    <span class="hljs-attr">template</span>: <span class="hljs-string">'&lt;router-view&gt;&lt;/router-view&gt;'</span>
                   })
                </code>
            </pre>
        
        </div>
<!--
        <div class="form-group">
            <label for="img-block" class="font-weight-bold mb-5">img block</label>
            <input type="text" class="form-control" name="img-block" id="img-block" aria-describedby="labelHelp">
        </div>
-->
        <div class="form-group">
            <label for="hash-title" class="font-weight-bold mt-n5">hash-title</label>
            <h3 class="h3-hash" id="Arbitrary-Route-Properties-replaced"><a href="" class="headerlink" title="" >Arbitrary Route Properties replaced</a></h3>
            
        </div>

        
  </div>
    </div>
  </div>
</div>


