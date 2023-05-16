<?php 
require_once(__DIR__ . '/../classes/faq.class.php');
require_once(__DIR__ . '/../database/faq.php');

function getFAQ(array $faqs){  ?>
    <?php foreach ($faqs as $faq) : ?>
        <div class="faq-item">
            <h3 class = "faq-questions"><?php echo $faq->question; ?>
                <svg width="15" height="10" viewBox="0 0 42 25">
                    <path d = "M3 3L21 21L39 3" stroke = "white" stroke-width= "7" stroke-linecap="round"/>
                </svg>
            </h3>
            <p class = "faq-answer"><?php echo $faq->answer; ?></p>
        </div>
    <?php endforeach; ?>
<?php } ?>


