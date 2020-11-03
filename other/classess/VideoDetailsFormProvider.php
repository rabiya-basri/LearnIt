<?php
class VideoDetailsFormProvider{

  private $con;

  public function __construct($con){
    $this->con = $con;

  }

    public function createUploadForm() {
        $fileinput = $this->createFileInput();
        $titleinput = $this->createTitleInput(null);
        $descriptioninput = $this->createDescriptionInput(null);
        $privacyinput = $this->createPrivacyInput(null);
        $categoriesinput = $this->createCategoriesInput(null);
        $uploadbutton = $this->createUploadButton();
        return"<form action='processing.php' method='POST' enctype='multipart/form-data'>
        $fileinput
        $titleinput
        $descriptioninput
        $privacyinput
        $categoriesinput
        $uploadbutton
        </form>
        ";
    }
    public function createEditDetailsForm($video) {
      $titleinput = $this->createTitleInput($video->getTitle());
      $descriptioninput = $this->createDescriptionInput($video->getDescription());
      $privacyinput = $this->createPrivacyInput($video->getPrivacy());
      $categoriesinput = $this->createCategoriesInput($video->getCategory());
      $savebutton = $this->createSaveButton();
      return"<form method='POST'>
      $titleinput
      $descriptioninput
      $privacyinput
      $categoriesinput
      $savebutton
      </form>
      ";
  }
    private function createFileInput(){
      return "<div class='form-group'>
    <input type='file' class='form-control-file' id='exampleFormControlFile1' name='fileInput' required>
  </div>";
    }
    private function createTitleInput($value){
      if($value == null) $value = "";
      return "<div class='form-group'>
      <input class='form-control form-control-lg' type='text' placeholder='Title' name='TitleInput' value='$value' autocomplete='off'>
      </div>
      ";
      
    }
    private function createDescriptionInput($value){
      if($value == null) $value = "";
      return "<div class='form-group'>
      <textarea class='form-control form-control-lg' placeholder='Description' name='DescriptionInput' rows='3'>$value</textarea>
      </div>
      ";
    }
    private function createPrivacyInput($value){
      if($value == null) $value = "";

      $privateSelected = ($value == 0) ? "selected='selected'" : "";
      $publicSelected = ($value == 1) ? "selected='selected'" : "";
      return "<div class='form-group'>
      <select  class='form-control' name='privacyInput'>
      <option value='0' $privateSelected>Private</option>
      <option value='1' $publicSelected>Public</option>
    </select>
    </div>
      ";
      
    }
    private function createCategoriesInput($value){
      if($value == null) $value = "";
      $query = $this->con->prepare("SELECT * FROM categories");
      $query->execute();

      $html = "<div class='form-group'>
      <select  class='form-control' name='categoryInput'>";

      while($row = $query->fetch(PDO::FETCH_ASSOC)){
        $id = $row["id"];
        $name = $row["name"];
        $selected = ($id == $value) ? "selected='selected'" : "";

         $html .="<option $selected value='$id'>$name</option>";
      }
      $html .="</select>
      </div>";

      return $html;
    }
    private function createUploadButton(){
      return "<button type='submit' class='btn btn-primary' name='uploadButton'>Upload</button>";
    }
    private function createSaveButton(){
      return "<button type='submit' class='btn btn-primary' name='saveButton'>Save</button>";
    }
}
?>