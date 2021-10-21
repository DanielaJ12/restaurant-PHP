<footer class="footer-area bg-f">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <h3>Despre</h3>
                <p>Ne place sa credem ca restaurantul reprezinta combinatia excelenta dintre starea de bine, contrastele naturii si serviciile premium de restaurant pe care le oferim cu tot dragul oaspetilor nostri! </p>
            </div>
            <div class="col-lg-3 col-md-6">
                <h3>Aboneaza-te</h3>
                <div class="subscribe_form">
                    <form class="subscribe_form">
                        <input name="EMAIL" id="subs-email" class="form_input" placeholder="Adresa de email..." type="email">
                        <button type="submit" class="submit">Aboneaza-te</button>
                        <div class="clearfix"></div>
                    </form>
                </div>
                <ul class="list-inline f-social">
                    <li class="list-inline-item"><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                    <li class="list-inline-item"><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-6">
                <h3>Contact</h3>
                <p class="lead">Strada WWW, Nr1A, Galati, 101000</p>
                <p class="lead"><a href="#">+40 yyyy yyyy</a></p>
                <p><a href="#"> admin@gmail.com</a></p>
            </div>
            <div class="col-lg-3 col-md-6">
                <h3>Program</h3>
                <p><span class="text-color">Luni-Vineri </span>10:00 - 22:30</p>
                <p><span class="text-color">Samabata-Duminica</span>10:00 - 23:00</p>
            </div>
        </div>
    </div>

    <div class="copyright">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p class="company-name">Drepturi rezervate &copy; 2020||2021 <a href="#">Restaurant</a> Design : Daniela</p>
                </div>
            </div>
        </div>
    </div>
</footer>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
toastr.options = {
  "closeButton": false,
  "debug": false,
  "newestOnTop": false,
  "progressBar": false,
  "positionClass": "toast-top-right",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "5000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
}
    

<?php if(isset($_SESSION['message'])){ 
    if($_SESSION['error']==1){
        $type = 'error';
    }else{
        $type = 'success';
    }
?>
toastr["<?php echo $type; ?>"]("<?php echo $_SESSION['message']; ?>");
<?php unset($_SESSION['message']); unset($_SESSION['error']); } ?>
</script>
