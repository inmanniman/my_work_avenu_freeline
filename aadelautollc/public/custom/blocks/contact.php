<section class="contact" id="contact">
    <div class="contact__wrapper container">
        <div class="contact__wrapper-content">
            <span class="contact__title">Контактная информация</span>
            <span class="contact__subtitle">Свяжитесь с нами удобными для вас способом:</span>
            <div class="contact__wrapper-apply">
                <a class="contact__box">
                    <div class="contact__wrapper-icon">
                        <svg class="contact__icon" width="56" height="56">
                            <use href="/assets/sprite.svg#vk"></use>
                        </svg>
                    </div>
                    <span class="contact__name">Группа ВК</span>
                </a>
                <a class="contact__box">
                    <div class="contact__wrapper-icon">
                        <svg class="contact__icon" width="56" height="56">
                            <use href="/assets/sprite.svg#telegram"></use>
                        </svg>
                    </div>
                    <span class="contact__name">Telegram</span>
                </a>
                <a class="contact__box">
                    <div class="contact__wrapper-icon">
                        <svg class="contact__icon" width="56" height="56">
                            <use href="/assets/sprite.svg#whatsapp"></use>
                        </svg>
                    </div>
                    <span class="contact__name">WhatsApp</span>
                </a>
                <a class="contact__box">
                    <div class="contact__wrapper-icon">
                        <svg class="contact__icon" width="56" height="56">
                            <use href="/assets/sprite.svg#email"></use>
                        </svg>
                    </div>
                    <span class="contact__name">Email</span>
                </a>
            </div>
        </div>
        <div class="contact__wrapper-feedback">
            <form class="feedback" action="/custom/functions/submit-form-number.php" method="post" onsubmit="submitForm(event)">
                <div class="feedback__wrapper-title">
                    <span class="feedback__title">Заполните форму, и мы перезвоним вам в ближайшее время</span>
                </div>
                <input type="text" class="feedback__input" placeholder="Ваш телефон" required name="phone_number-form" id="phone_number-form" />
                <button type="submit" class="feedback__btn" id="submitBtn">ПЕРЕЗВОНИТЕ МНЕ</button>
                <span class="feedback__txt feedback__txt_bold">Нужно срочно?</span>
                <span class="feedback__txt">Проведем осмотр и консультацию по видеосвязи</span>
                <span class="feedback__txt feedback__txt_bold">Звоните:</span>
                <a href="tel:89219459236" class="feedback__number feedback__number_bold">+7 (921) 945-92-36</a>
                <span class="feedback__around">Круглосуточно</span>
            </form>
        </div>
    </div>
</section>