<div>
    <div
        class="flex h-screen justify-center items-center w-full bg-gradient-to-r from-blue-200 to-cyan-200 py-10 px-4 sm:px-6 lg:px-8 mx-auto">
        <div class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 gap-4 md:gap-8 xl:gap-20 md:items-center">
                <div>
                    <h1 class="block text-3xl font-bold text-gray-800 sm:text-4xl lg:text-6xl lg:leading-tight dark:text-white">
                        Снежинские краски</h1>
                    <p class="mt-3 text-lg text-gray-800 dark:text-gray-400">Производство антикоррозионных и
                        огнезащитных лакокрасочных материалов и систем.</p>
                    <div class="mt-7 grid gap-3 w-full sm:inline-flex">
                        <a class="py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                           href="/register">
                            Посмотреть продукцию
                            <svg class="flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                 viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path d="m9 18 6-6-6-6"/>
                            </svg>
                        </a>
                        <a class="py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-white dark:hover:bg-gray-800 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                           href="/contact">
                            Связаться с нами
                        </a>
                    </div>
                </div>
                <div class="relative ms-4">

                    <img class="w-full max-w-md mx-auto rounded-md"
                         src="{{ Vite::asset('resources/images/hero-image.webp') }}" alt="Image Description">
                    <div
                        class="absolute inset-0 -z-[1] bg-gradient-to-tr from-gray-200 via-white/0 to-white/0 w-full h-full rounded-md mt-4 -mb-4 me-4 -ms-4 lg:mt-6 lg:-mb-6 lg:me-6 lg:-ms-6 dark:from-slate-800 dark:via-slate-900/0 dark:to-slate-900/0"></div>
                </div>
            </div>
        </div>
    </div>
    <section class="py-20">
        <div class="max-w-xl mx-auto">
            <div class="text-center">
                <div class="relative flex flex-col items-center">
                    <h1 class="text-5xl font-bold dark:text-gray-200">
                        Типы <span class="text-blue-500">покрытий</span>
                    </h1>
                    <div class="flex w-40 mt-2 mb-6 overflow-hidden rounded">
                        <div class="flex-1 h-2 bg-blue-200"></div>
                        <div class="flex-1 h-2 bg-blue-400"></div>
                        <div class="flex-1 h-2 bg-blue-600"></div>
                    </div>
                </div>
                <p class="mb-12 text-base text-center text-gray-500">
                    Наш ассортимент разнообразных покрытий
                </p>
            </div>
        </div>
        <div class="max-w-6xl px-4 mx-auto">
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                <a href="#"
                   class="block p-6 transition-transform transform bg-white border border-gray-300 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700 hover:shadow-lg hover:scale-105 hover:bg-blue-50 dark:hover:bg-gray-700">
                    <h2 class="mb-2 text-2xl font-semibold text-blue-600 dark:text-blue-400">Полиуретановая</h2>
                    <p class="text-gray-700 dark:text-gray-300">Высокая стойкость к механическим и химическим
                        воздействиям. Отличный выбор для защиты металла и бетона.</p>
                </a>

                <a href="#"
                   class="block p-6 transition-transform transform bg-white border border-gray-300 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700 hover:shadow-lg hover:scale-105 hover:bg-blue-50 dark:hover:bg-gray-700">
                    <h2 class="mb-2 text-2xl font-semibold text-blue-600 dark:text-blue-400">Цинконаполненная</h2>
                    <p class="text-gray-700 dark:text-gray-300">Отличная защита от коррозии благодаря высокой
                        концентрации цинка. Часто используется для металлоконструкций.</p>
                </a>

                <a href="#"
                   class="block p-6 transition-transform transform bg-white border border-gray-300 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700 hover:shadow-lg hover:scale-105 hover:bg-blue-50 dark:hover:bg-gray-700">
                    <h2 class="mb-2 text-2xl font-semibold text-blue-600 dark:text-blue-400">Алкидно-уретановая</h2>
                    <p class="text-gray-700 dark:text-gray-300">Гибкость и износостойкость, подходит для деревянных
                        и металлических поверхностей.</p>
                </a>

                <a href="#"
                   class="block p-6 transition-transform transform bg-white border border-gray-300 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700 hover:shadow-lg hover:scale-105 hover:bg-blue-50 dark:hover:bg-gray-700">
                    <h2 class="mb-2 text-2xl font-semibold text-blue-600 dark:text-blue-400">Пенетрирующая</h2>
                    <p class="text-gray-700 dark:text-gray-300">Глубоко проникает в поры поверхности, обеспечивая
                        долговременную защиту от влаги и химических воздействий.</p>
                </a>

                <a href="#"
                   class="block p-6 transition-transform transform bg-white border border-gray-300 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700 hover:shadow-lg hover:scale-105 hover:bg-blue-50 dark:hover:bg-gray-700">
                    <h2 class="mb-2 text-2xl font-semibold text-blue-600 dark:text-blue-400">Эпоксидный состав</h2>
                    <p class="text-gray-700 dark:text-gray-300">Обладает высокой прочностью, устойчив к химическим и
                        механическим нагрузкам. Отлично подходит для промышленных объектов.</p>
                </a>

                <a href="#"
                   class="block p-6 transition-transform transform bg-white border border-gray-300 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700 hover:shadow-lg hover:scale-105 hover:bg-blue-50 dark:hover:bg-gray-700">
                    <h2 class="mb-2 text-2xl font-semibold text-blue-600 dark:text-blue-400">Органоразбовляемый
                        модифицированный сополимер</h2>
                    <p class="text-gray-700 dark:text-gray-300">Универсальное покрытие с высокой эластичностью и
                        адгезией к различным поверхностям.</p>
                </a>

                <a href="#"
                   class="block p-6 transition-transform transform bg-white border border-gray-300 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700 hover:shadow-lg hover:scale-105 hover:bg-blue-50 dark:hover:bg-gray-700">
                    <h2 class="mb-2 text-2xl font-semibold text-blue-600 dark:text-blue-400">Акриловая</h2>
                    <p class="text-gray-700 dark:text-gray-300">Устойчивость к ультрафиолету, высокая эластичность и
                        долговечность. Подходит для фасадных работ.</p>
                </a>

                <a href="#"
                   class="block p-6 transition-transform transform bg-white border border-gray-300 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700 hover:shadow-lg hover:scale-105 hover:bg-blue-50 dark:hover:bg-gray-700">
                    <h2 class="mb-2 text-2xl font-semibold text-blue-600 dark:text-blue-400">Огнезащитная</h2>
                    <p class="text-gray-700 dark:text-gray-300">Замедляет распространение огня, используется для
                        защиты деревянных, металлических и бетонных конструкций.</p>
                </a>
            </div>
        </div>
    </section>
    <div class="bg-blue-200 py-20">
        <div class="max-w-xl mx-auto">
            <div class="text-center ">
                <div class="relative flex flex-col items-center">
                    <h1 class="text-5xl font-bold dark:text-gray-200"> Список <span class="text-blue-500"> категорий
          </span></h1>
                    <div class="flex w-40 mt-2 mb-6 overflow-hidden rounded">
                        <div class="flex-1 h-2 bg-blue-200">
                        </div>
                        <div class="flex-1 h-2 bg-blue-400">
                        </div>
                        <div class="flex-1 h-2 bg-blue-600">
                        </div>
                    </div>
                </div>
                <p class="mb-12 text-base text-center ">
                    Ознакомьтесь с широким ассортиментом продукции
                </p>
            </div>
        </div>

        <div class="max-w-[85rem] px-4 sm:px-6 lg:px-8 mx-auto">
            <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-3 sm:gap-6">
                <a class="group flex flex-col bg-white border shadow-sm rounded-xl hover:shadow-md transition dark:bg-slate-900 dark:border-gray-800 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                   href="#">
                    <div class="p-4 md:p-5">
                        <div class="flex justify-between items-center">
                            <div class="flex items-center">
                                <img class="h-[2.375rem] w-[2.375rem] rounded-full"
                                     src="https://cdn.bajajelectronics.com/product/b002c02c-c379-49f8-b2a6-bd2e56d0e23a"
                                     alt="Image Description">
                                <div class="ms-3">
                                    <h3 class="group-hover:text-blue-600 font-semibold text-gray-800 dark:group-hover:text-gray-400 dark:text-gray-200">
                                        Антикоррозионные материалы и покрытия
                                    </h3>
                                </div>
                            </div>
                            <div class="ps-3">
                                <svg class="flex-shrink-0 w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24"
                                     height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                     stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m9 18 6-6-6-6"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </a>

                <a class="group flex flex-col justify-center bg-white border shadow-sm rounded-xl hover:shadow-md transition dark:bg-slate-900 dark:border-gray-800 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                   href="#">
                    <div class="p-4 md:p-5">
                        <div class="flex justify-between items-center">
                            <div class="flex items-center">
                                <img class="h-[2.375rem] w-[2.375rem] rounded-full"
                                     src="https://static.toiimg.com/thumb/msid-86223197,width-400,resizemode-4/86223197.jpg"
                                     alt="Image Description">
                                <div class="ms-3">
                                    <h3 class="group-hover:text-blue-600 font-semibold text-gray-800 dark:group-hover:text-gray-400 dark:text-gray-200">
                                        Защита от подземной коррозии
                                    </h3>
                                </div>
                            </div>
                            <div class="ps-3">
                                <svg class="flex-shrink-0 w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24"
                                     height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                     stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m9 18 6-6-6-6"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </a>

                <a class="group flex flex-col bg-white border shadow-sm rounded-xl hover:shadow-md transition dark:bg-slate-900 dark:border-gray-800 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                   href="#">
                    <div class="p-4 md:p-5">
                        <div class="flex justify-between items-center">
                            <div class="flex items-center">
                                <img class="h-[2.375rem] w-[2.375rem] rounded-full"
                                     src="https://store.storeimages.cdn-apple.com/4668/as-images.apple.com/is/watch-card-40-ultra2-202309_GEO_IN_FMT_WHH?wid=508&hei=472&fmt=p-jpg&qlt=95&.v=1693611639854"
                                     alt="Image Description">
                                <div class="ms-3">
                                    <h3 class="group-hover:text-blue-600 font-semibold text-gray-800 dark:group-hover:text-gray-400 dark:text-gray-200">
                                        Защита бетона
                                    </h3>
                                </div>
                            </div>
                            <div class="ps-3">
                                <svg class="flex-shrink-0 w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24"
                                     height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                     stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m9 18 6-6-6-6"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </a>

                <a class="group flex flex-col bg-white border shadow-sm rounded-xl hover:shadow-md transition dark:bg-slate-900 dark:border-gray-800 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                   href="#">
                    <div class="p-4 md:p-5">
                        <div class="flex justify-between items-center">
                            <div class="flex items-center">
                                <img class="h-[2.375rem] w-[2.375rem] rounded-full"
                                     src="https://i01.appmifile.com/v1/MI_18455B3E4DA706226CF7535A58E875F0267/pms_1632893007.55719480!400x400!85.png"
                                     alt="Image Description">
                                <div class="ms-3">
                                    <h3 class="group-hover:text-blue-600 font-semibold text-gray-800 dark:group-hover:text-gray-400 dark:text-gray-200">
                                        Огнезащитные покрытия
                                    </h3>
                                </div>
                            </div>
                            <div class="ps-3">
                                <svg class="flex-shrink-0 w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24"
                                     height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                     stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m9 18 6-6-6-6"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </a>

            </div>
        </div>

    </div>

 {{-- Отзывы покупателей   --}}
    <section class="py-14 font-poppins dark:bg-gray-800">
        <div class="max-w-6xl px-4 py-6 mx-auto lg:py-4 md:px-6">
            <div class="max-w-xl mx-auto">
                <div class="text-center">
                    <div class="relative flex flex-col items-center">
                        <h1 class="text-5xl font-bold dark:text-gray-200">Отзывы <span class="text-blue-500">клиентов</span></h1>
                        <div class="flex w-40 mt-2 mb-6 overflow-hidden rounded">
                            <div class="flex-1 h-2 bg-blue-200"></div>
                            <div class="flex-1 h-2 bg-blue-400"></div>
                            <div class="flex-1 h-2 bg-blue-600"></div>
                        </div>
                    </div>
                    <p class="mb-12 text-base text-center text-gray-500">
                        Узнайте, что говорят наши клиенты о наших продуктах и услугах.
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">

                <!-- Отзыв 1 -->
                <div class="py-6 bg-white rounded-md shadow dark:bg-gray-900">
                    <div class="flex flex-wrap items-center justify-between pb-4 mb-6 space-x-2 border-b dark:border-gray-700">
                        <div class="flex items-center px-6 mb-2 md:mb-0">
                            <div class="flex mr-2 rounded-full">
                                <img src="https://i.postimg.cc/rF6G0Dh9/pexels-emmy-e-2381069.jpg" alt="" class="object-cover w-12 h-12 rounded-full hidden sm:inline-block">
                            </div>
                            <div>
                                <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-300">Александр Громов</h2>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Инженер-технолог</p>
                            </div>
                        </div>
                        <p class="px-6 text-base font-medium text-gray-600 dark:text-gray-400">Присоединился 12 сентября 2022</p>
                    </div>
                    <p class="px-6 mb-6 text-base text-gray-500 dark:text-gray-400">
                        Работаем с «Снежинскими красками» уже несколько лет. Антикоррозийные покрытия действительно надежные – используем их для защиты металлоконструкций на промышленных объектах. Краска ложится ровно, держится годами, что подтверждают испытания на наших предприятиях в сложных климатических условиях. Отличное качество!
                    </p>
                    <div class="flex flex-wrap justify-between pt-4 border-t dark:border-gray-700">
                        <div class="flex px-6 mb-2 md:mb-0">
                            <h2 class="text-sm text-gray-500 dark:text-gray-400">Рейтинг: <span class="font-semibold text-gray-600 dark:text-gray-300">3.0</span></h2>
                        </div>
                    </div>
                </div>

                <!-- Отзыв 2 -->
                <div class="py-6 bg-white rounded-md shadow dark:bg-gray-900">
                    <div class="flex flex-wrap items-center justify-between pb-4 mb-6 space-x-2 border-b dark:border-gray-700">
                        <div class="flex items-center px-6 mb-2 md:mb-0">
                            <div class="flex mr-2 rounded-full">
                                <img src="https://i.postimg.cc/q7pv50zT/pexels-edmond-dant-s-4342352.jpg" alt="" class="object-cover w-12 h-12 rounded-full hidden sm:inline-block">
                            </div>
                            <div>
                                <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-300">Ирина Васильева</h2>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Главный инженер строительной компании</p>
                            </div>
                        </div>
                        <p class="px-6 text-base font-medium text-gray-600 dark:text-gray-400">Присоединилась 12 сентября 2022</p>
                    </div>
                    <p class="px-6 mb-6 text-base text-gray-500 dark:text-gray-400">
                        Отличные огнезащитные покрытия! Применяем их в строительных проектах, где требуется высокая степень защиты металла. Материалы полностью сертифицированы, что важно для нас и наших заказчиков. Благодарим за оперативные поставки и консультации, работаем только с вами!
                    </p>
                    <div class="flex flex-wrap justify-between pt-4 border-t dark:border-gray-700">
                        <div class="flex px-6 mb-2 md:mb-0">
                            <h2 class="text-sm text-gray-500 dark:text-gray-400">Рейтинг: <span class="font-semibold text-gray-600 dark:text-gray-300">3.0</span></h2>
                        </div>
                    </div>
                </div>
                <div class="py-6 bg-white rounded-md shadow dark:bg-gray-900">
                    <div class="flex flex-wrap items-center justify-between pb-4 mb-6 space-x-2 border-b dark:border-gray-700">
                        <div class="flex items-center px-6 mb-2 md:mb-0">
                            <div class="flex mr-2 rounded-full">
                                <img src="https://i.postimg.cc/JzmrHQmk/pexels-pixabay-220453.jpg" alt="" class="object-cover w-12 h-12 rounded-full hidden sm:inline-block">
                            </div>
                            <div>
                                <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-300">Виталий Кудряшов</h2>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Начальник отдела снабжения нефтеперерабатывающего завода</p>
                            </div>
                        </div>
                        <p class="px-6 text-base font-medium text-gray-600 dark:text-gray-400">Присоединился 12 сентября 2022</p>
                    </div>
                    <p class="px-6 mb-6 text-base text-gray-500 dark:text-gray-400">
                        Заказывали антикоррозионную эмаль для защиты металлических конструкций. Легко наносится, быстро высыхает, создает прочную пленку. Радует, что продукция соответствует заявленным характеристикам. Единственный минус – хотелось бы чуть более гибкие условия поставки, но в целом очень довольны.
                    </p>
                    <div class="flex flex-wrap justify-between pt-4 border-t dark:border-gray-700">
                        <div class="flex px-6 mb-2 md:mb-0">
                            <h2 class="text-sm text-gray-500 dark:text-gray-400">Рейтинг: <span class="font-semibold text-gray-600 dark:text-gray-300">3.0</span></h2>
                        </div>
                    </div>
                </div>
                <div class="py-6 bg-white rounded-md shadow dark:bg-gray-900">
                    <div class="flex flex-wrap items-center justify-between pb-4 mb-6 space-x-2 border-b dark:border-gray-700">
                        <div class="flex items-center px-6 mb-2 md:mb-0">
                            <div class="flex mr-2 rounded-full">
                                <img src="https://i.postimg.cc/JzmrHQmk/pexels-pixabay-220453.jpg" alt="" class="object-cover w-12 h-12 rounded-full hidden sm:inline-block">
                            </div>
                            <div>
                                <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-300">Сергей Лебедев</h2>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Главный конструктор судостроительной компании</p>
                            </div>
                        </div>
                        <p class="px-6 text-base font-medium text-gray-600 dark:text-gray-400">Присоединился 12 сентября 2022</p>
                    </div>
                    <p class="px-6 mb-6 text-base text-gray-500 dark:text-gray-400">
                        Используем покрытия от «Снежинских красок» в судостроении. Коррозия – главный враг металлоконструкций, а эти материалы реально помогают продлить срок службы изделий. Отличное сцепление, высокая стойкость к агрессивным средам. Однозначно будем продолжать сотрудничество!
                    </p>
                    <div class="flex flex-wrap justify-between pt-4 border-t dark:border-gray-700">
                        <div class="flex px-6 mb-2 md:mb-0">
                            <h2 class="text-sm text-gray-500 dark:text-gray-400">Рейтинг: <span class="font-semibold text-gray-600 dark:text-gray-300">3.0</span></h2>
                        </div>
                    </div>
                </div>
                <div class="py-6 bg-white rounded-md shadow dark:bg-gray-900">
                    <div class="flex flex-wrap items-center justify-between pb-4 mb-6 space-x-2 border-b dark:border-gray-700">
                        <div class="flex items-center px-6 mb-2 md:mb-0">
                            <div class="flex mr-2 rounded-full">
                                <img src="https://i.postimg.cc/JzmrHQmk/pexels-pixabay-220453.jpg" alt="" class="object-cover w-12 h-12 rounded-full hidden sm:inline-block">
                            </div>
                            <div>
                                <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-300">Марина Коваленко</h2>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Начальник отдела качества строительной компании</p>
                            </div>
                        </div>
                        <p class="px-6 text-base font-medium text-gray-600 dark:text-gray-400">Присоединился 12 сентября 2022</p>
                    </div>
                    <p class="px-6 mb-6 text-base text-gray-500 dark:text-gray-400">
                        Заказывали защитные покрытия для бетонных конструкций. Прекрасная адгезия, долговечность, удобство в нанесении. Всё соответствует заявленным характеристикам и сертификации. Приятно работать с профессионалами, которые знают свое дело. Спасибо за надежную продукцию!
                    </p>
                    <div class="flex flex-wrap justify-between pt-4 border-t dark:border-gray-700">
                        <div class="flex px-6 mb-2 md:mb-0">
                            <h2 class="text-sm text-gray-500 dark:text-gray-400">Рейтинг: <span class="font-semibold text-gray-600 dark:text-gray-300">3.0</span></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
