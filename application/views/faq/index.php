<style>
.datafaqs .collapsible {
background-color: #03aad1;
    color: white;
    cursor: pointer;
    padding: 18px;
    width: 100%;
    border: none;
    text-align: left;
    outline: none;
    font-size: 15px;
}

.datafaqs .active, .collapsible:hover {
  background-color: #555;
}

.datafaqs .collapsible:after {
  content: '\002B';
  color: white;
  font-weight: bold;
  float: right;
  margin-left: 5px;
}

.datafaqs .active:after {
  content: "\2212";
}

.datafaqs .content {
  padding: 0 18px;
  max-height: 0;
  overflow: hidden;
  transition: max-height 0.2s ease-out;
  background-color: #f1f1f1;
}
.datafaqs{
    margin:50px 0px;
}
/*.content{*/
/*        max-height: 100% !important;*/
/*}*/
.datafaqs p {
    margin: 50px 0px;
}
</style>



<section class="faqs-main">

    <div class="body-space">

        <div class="container">

            <div class="mfaq">

                <h2>FAQ</h2>
<section class="datafaqs">
               

               
<button class="collapsible">How can a listing on The Northern Ireland Connection be important for me or my business?</button>
<div class="content">
  <p>The Northern Ireland Connection is not only a site that guides prospective clients to your businesses it allows you to gain trust with potential clients, don’t just show with a picture, grow with a video</p>
</div>


<button class="collapsible">How long does it take for my listing to be posted on The Northern Ireland Connection?</button>
<div class="content">
  <p>Please allow up to 24-48 hours for a review of your listing. Following review if there are no problems/questions your listing will be posted.</p>
</div>
<button class="collapsible">How long will the listing be active?</button>
<div class="content">
  <p>The subscription listing fee will provide your category listing and full EASY access to manage your account for the period of your package subject to our Websites Terms & Conditions and at any time you can edit your key words, website information, description or any other information that is necessary to keep your site up to date.</p>
</div>
<button class="collapsible">Will I receive a reminder when my ad is about to expire?</button>
<div class="content">
  <p>All packages auto renew unless you opt out of this feature.  You will receive a message 3 days prior to your ad renewing/expiring.</p>
</div>
<button class="collapsible">I don’t see my category and/or sub-category anywhere?</button>
<div class="content">
  <p>If the category for your business type isn’t listed anywhere, then feel free to use our contact page, and request them to be added.</p>
</div>
<button class="collapsible">What size should my image uploads be?</button>
<div class="content">
  <p>Optimal image size should be 320w X 240h in pixels.</p>
</div>

        </section>       

            </div>

        </div>

    </div>

</section>

<script>
var coll = document.getElementsByClassName("collapsible");
var i;

for (i = 0; i < coll.length; i++) {
  coll[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var content = this.nextElementSibling;
    if (content.style.maxHeight){
      content.style.maxHeight = null;
    } else {
      content.style.maxHeight = content.scrollHeight + "px";
    } 
  });
}
</script>
