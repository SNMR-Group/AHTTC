
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">


<section>
    <a href="#" id="scroll-top" class="scroll-top"><i class="bi bi-arrow-up"></i></a>
</section>

 <style>
  
      #scroll-top {
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        display: flex;
        justify-content: center;
        align-items: center;
        visibility: hidden;
        transform: translateY(100px);
        transition: all 0.3s ease-in-out;
    }

    #scroll-top.active {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }
 </style>
   
   <script>
        window.addEventListener("scroll", function() {
            const scrollTopButton = document.getElementById("scroll-top");
            if (window.scrollY > 300) {
                scrollTopButton.classList.add("active");
            } else {
                scrollTopButton.classList.remove("active");
            }
        });

        document.getElementById("scroll-top").addEventListener("click", function(e) {
            e.preventDefault();
            window.scrollTo({
                top: 0,
                behavior: "smooth"
            });
        });
    </script>