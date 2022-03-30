  <?php include('header.php');?>
  <link rel="stylesheet" href="validation/dist/css/bootstrapValidator.css"/>
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
  <script>
      document.getElementById("nav1").className = "nav-item"; 
      document.getElementById("nav2").className = "nav-item";
      document.getElementById("nav3").className = "nav-item"; 
      document.getElementById("nav4").className = "nav-item"; 
      document.getElementById("nav5").className = "nav-item"; 
      document.getElementById("nav6").className += "active"; 
      document.getElementById("nav7").className = "nav-item"; 
  </script>
  <script type="text/javascript" src="validation/dist/js/bootstrapValidator.js"></script>
    <?php
      include('form.php');
      $frm=new formBuilder;      
    ?>
  </div>
  <body ng-app="myApp" ng-controller="myctrl">
  <div class="content" >
      <div class="wrap">
          <div class="content-top" style="min-height:300px;padding:50px">
              <div class="col-md-4 col-md-offset-4">
                  <div class="panel panel-default">
                    <div class="panel-heading">Register</div>
                    <div class="panel-body">
                  <form action="process_registration.php" method="post" id="form1" name="myform">
                      <div class="form-group has-feedback">
          <input name="name" type="text" size="25" ng-model="name" placeholder="Name" class="form-control" ng-required="true" ng-pattern="/^[a-zA-Z]+(([',. -][a-zA-Z ])?[a-zA-Z]*)*$/"/>
          <span   ng-show="myform.name.$error.pattern" style="color: red;">Name can have only alphabets.</span>
        </div>
        <div class="form-group has-feedback">
          <input name="age" ng-model="age" type="text" size="25" placeholder="Age" class="form-control"  ng-required="true" ng-pattern="/^(?:1[8-9]|[2-5][0-9]|60)$/" />
          <span ng-show="myform.age.$error.pattern" style="color: red;">*Invalid Age. Valid 18-60</span>
        </div>
        <div class="form-group has-feedback">
        <select ng-model="gender" name="gender" ng-required="true"  class="form-control">
      <option value="" disabled selected hidden>Select Gender</option>
      <option ng-repeat="m in genlist">{{m}}</option>
  </select>
        </div>
        <div class="form-group has-feedback">
          <input name="phone" type="text" size="25" placeholder="Mobile Number" class="form-control" ng-model="phone" ng-pattern="/^[0-9]*$/" ng-required="true" ng-minlength="6" ng-maxlength="10"/>
          <span ng-show="myform.phone.$error.minlength" style="color: red;">Minimum 6 digits required.</span>
          <span ng-show="myform.phone.$error.pattern" style="color: red;">Phone number can have only digits.</span>
          <span ng-show="myform.phone.$error.maxlength" style="color: red;">Maximum 10 digits allowed.</span>
        </div>
        <div class="form-group has-feedback">
          <input name="email" type="text" size="25" placeholder="Email" class="form-control" ng-model="email" ng-required="true" ng-pattern="/^[a-zA-Z0-9._]+@[a-zA-Z0-9.]+\.[a-zA-Z]{3}$/"/>
          <span ng-show="myform.email.$error.pattern" style="color: red;">Email has to be in format abc@gmail.com.</span>
        </div>
        <div class="form-group has-feedback">
          <input name="password" type="password" size="25" placeholder="Password" class="form-control" placeholder="Password"  ng-model="pass" ng-required="true" ng-pattern="/^(?=.*[A-Z])(?=.*[0-9])(?=.*[@#$%^&]).{6,10}$/" ng-minlength="6" ng-maxlength="10"/>
          <span ng-show="myform.password.$error.pattern" style="color: red;">Password should have 1 capital alphabet, 1 digit, 1 special character.</span>
          <span ng-show="myform.password.$error.minlength" style="color: red;">Minimum 6 characters required.</span>
          <span ng-show="myform.password.$error.maxlength" style="color: red;">Maximum 10 characters allowed.</span>
        </div>
        <div class="form-group has-feedback">
          <input name="cpassword" type="password" size="25" placeholder="Password" class="form-control" compare-to="pass" placeholder="Password" ng-model="cpassword" ng-required="true"/>
          <span  ng-if="myform.password.$touched" ng-show="myform.cpassword.$error.compareTo" style="color: red;">Passwords don't match.</span>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary" ng-disabled="myform.$invalid">Continue</button>
        </div>
        </div>
  </div>
      </form>
              </div>
          </div>
          <div class="clear"></div>
      </div>
  <?php include('footer.php');?>
  </div>
  <script type="text/javascript">
      var app=angular.module('myApp',[]);
      app.controller('myctrl',function($scope){
        $scope.value=0;
          $scope.name='';
          $scope.genlist=["Male","Female"];
          $scope.user = {  
          password: "",  
          confirmPassword: ""
      };  
      });
      app.directive("compareTo", function ()  
  {  
      return {  
          require: "ngModel",  
          scope:  
          {  
              confirmPassword: "=compareTo"
          },  
          link: function (scope, element, attributes, modelVal)  
          {  
              modelVal.$validators.compareTo = function (val)  
              {  
                  return val == scope.confirmPassword;  
              };  
              scope.$watch("confirmPassword", function ()  
              {  
                  modelVal.$validate();  
              });  
          }  
      };  
  });  
  </script>
  </body>
  <script>
    <?php $frm->applyvalidations("form1");?>
  </script>