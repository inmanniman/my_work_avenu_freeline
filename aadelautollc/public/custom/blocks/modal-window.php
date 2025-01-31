<div class="contact__wrapper-feedback" id="modal-form" style="display:none">
    <div class="contact__tab">
        <div class="contact__wrapper-tab">
            <input class="contact__application-form" checked id="application-form" name="tab-btn" type="radio" value="">
            <label class="contact__application-label" for="application-form">Application form</label>
            <input class="contact__number-form" id="number-form" name="tab-btn" type="radio" value="">
            <label class="contact__number-label" for="number-form">Number form</label>
        </div>

        <div class="contact__tab-content contact__application-content" id="content-application">
            <form class="feedback" action="/custom/functions/submit-form.php" method="post" onsubmit="submitForm(event)">
                <div class="feedback__wrapper-title">
                    <span class="feedback__title">Заполните форму, и мы перезвоним вам в ближайшее время</span>
                </div>

                <label for="full_name">Full name:</label>
                <input type="text" class="feedback__input" name="full_name" id="full_name" placeholder="Full name" required>

                <label for="car_brand">Car brand:</label>
                <input type="text" class="feedback__input" name="car_brand" id="car_brand" placeholder="Car brand" required>

                <label for="type_car">Type of engine: </label>
                <select class="feedback__input feedback__input_select" id="type_car" name="type_car">
                    <option>Прочее</option>
                    <option>Дизель</option>
                    <option>Бензин</option>
                    <option>Гибрид</option>
                </select>

                <label for="VIN">VIN number:</label>
                <input type="text" class="feedback__input" name="VIN" id="VIN" placeholder="VIN" required>

                <label for="city_street">Адрес:</label>
                <input type="tel" class="feedback__input" name="city_street" id="city_street" placeholder="Адрес" required>

                <label for="phone_number">Номер телефона:</label>
                <input type="text" class="feedback__input feedback__input-phone-number" name="phone_number" id="phone_number" placeholder="Ваш телефон">
                <div class="feedback__wrapper-date">
                    <label for="period">Date:</label>
                    <input id="period" name="period" type="text" class="feedback__input" value="" style="cursor: pointer;" required />
                    <div class="date" style="display: none;">
                        <input id="datePeriod" name="datePeriod" class="date__input" data-selected-date type="text" readonly />
                        <div class="date__wrapper-clock">
                            <?php
                            for ($i = 1; $i <= 27; $i++) {
                                $hour = floor(($i - 1) / 2) + 9; // Вычисляем час
                                $minute = ($i % 2 == 0) ? "30" : "00"; // Вычисляем минуты
                                $am_pm = ($hour < 12) ? "am" : "pm"; // Определяем AM или PM
                                if ($hour > 12) {
                                    $hour -= 12;
                                }

                                echo '<input id="' . $i . '" type="radio" class="date__clock"><label for="' . $i . '" class="date__clock-txt">' . sprintf("%02d:%s%s", $hour, $minute, $am_pm) . '</label>' . PHP_EOL;
                            }
                            ?>
                        </div>
                        <span class="date__error"></span>
                        <div class="date__wrapper-btn">
                            <input type="button" id="dateBtn" class="date__btn" value="Записать" />
                        </div>
                    </div>
                </div>

                <label for="comment">Комментарий:</label>
                <textarea class="feedback__input" name="comment" id="comment" placeholder="Комментарий" cols="50" rows="6" minlength="20" maxlength="400"></textarea>

                <button type="submit" class="feedback__btn" id="submitBtn">Отправить заявку</button>
                <span class="feedback__txt feedback__txt_bold">Нужно срочно?</span>
                <span class="feedback__txt">Проведем осмотр и консультацию по видеосвязи</span>
                <span class="feedback__txt feedback__txt_bold">Звоните:</span>
                <a href="tel:89219459236" class="feedback__number feedback__number_bold">+7 (921) 945-92-36</a>
                <span class="feedback__around">Круглосуточно</span>
            </form>
        </div>

        <div class="contact__tab-content contact__number-content" id="content-number">
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
</div>