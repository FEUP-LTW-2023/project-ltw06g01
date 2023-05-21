<?php
require_once(__DIR__ . '/../classes/faq.class.php');
require_once(__DIR__ . '/../database/faq.php');

function getFAQ(array $faqs)
{  ?>

    <?php foreach ($faqs as $faq) : ?>
        <div class="faq-item">
            <h3 class="faq-questions"><?php echo $faq->question; ?>
                <svg width="15" height="10" viewBox="0 0 42 25">
                    <path d="M3 3L21 21L39 3" stroke="#55b0c6" stroke-width="7" fill="#55b0c6" />
                </svg>

            </h3>
            <p class="faq-answer"><?php echo $faq->answer; ?></p>
        </div>
    <?php endforeach; ?>
<?php }

function drawFAQForm()
{ ?>
    <form class="faq-form">
        <input type="hidden" name="csrf" value=<?= $_SESSION['csrf'] ?>>

        <h3 class="faq-questions">Adicionar novo FAQ</h3>
        <label for="question">Pergunta:</label>
        <input type="text" class="question" name="question">
        <label for="answer">Resposta:</label>
        <textarea class="answer" name="answer"></textarea>
        <button type="submit" formmethod="post" formaction="../actions/add_faqitem.action.php">Submit</button>
    </form>
<?php } ?>