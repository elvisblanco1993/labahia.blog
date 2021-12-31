<div id="disqus_thread" class="mt-5 max-w-3xl mx-auto px-4 sm:px-6 lg:px-8"></div>
<script>
    /**
    *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
    *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables
    **/

    var disqus_config = function () {
        this.page.url = "{{ config('app.url') }}";  // Replace PAGE_URL with your page's canonical URL variable
        this.page.identifier = "{{ $article->uuid }}"; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
        this.language = "es_ES";
    };

    (function() { // DON'T EDIT BELOW THIS LINE
    var d = document, s = d.createElement('script');
    s.src = 'https://la-bahia-blog.disqus.com/embed.js';
    s.setAttribute('data-timestamp', +new Date());
    (d.head || d.body).appendChild(s);
    })();
</script>
<script id="dsq-count-scr" src="//labahia.disqus.com/count.js" async></script>
<noscript>Por favor habilite la ejecución de javascript para poder ver los <a href="https://disqus.com/?ref_noscript">comentarios por Disqus.</a></noscript>
