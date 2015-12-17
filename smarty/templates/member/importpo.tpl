<form name="frm" id="frm">
<div id="user">
                <div class="users">
                    <h4>User #1</h4>
                    <label for="fname_1">First Name</label>
                    <input type="text" name="fname_1" id="fname_1">
               <br/>
               <label for="lname_1">Last Name</label>
                <input type="text" name="lname_1" id="lname_1">

            </div>
</div>
<div id="moreUsers"></div>
<div id="addUser">Add User</div><div id="removeUser">Remove</div>
</form>

{literal}
<script>
var currentUserCount = 1;
$('#addUser').click(function(){
            currentUserCount = cloning('#user', '#moreUsers', currentUserCount);
            return false;
        });

$('#removeUser').click(function(){
                $('.users:last').remove();
                currentUserCount--;
            return false;
        });

function cloning(from, to, counter) {
          var clone = $(from).clone();

          counter++;
          // Replace the input attributes:
          clone.find(':input').each(function() {
              //alert(counter);
              var name = $(this).attr('name').replace(1,counter);
              var id = $(this).attr('id').replace(1,counter);
              $(this).attr({'name': name, 'id': id}).val('');
          });

          // Replace the label for attribute:
          clone.find('label').each(function() {
              var newFor = $(this).attr('for').replace(1,counter);
              $(this).attr('for', newFor);
          });
          //alert(counter);
          // Replace the text between html tags:
          clone = clone.html().replace(1,counter);
          $(to).before(clone);
          return counter;
      } // end cloning

</script>
{/literal}