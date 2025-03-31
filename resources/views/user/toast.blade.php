    @if (session()->has('message'))
        <div id="toast-message-cta"
            class="shadow-lg bg-[#baa538] w-full absolute top-1/2 left-0 sm:left-10 md:left-32 lg:left-44 sm:max-w-sm  md:max-w-md lg:max-w-md xl:max-w-md  p-4 text-black  rounded-lg"
            role="alert">
            <div class="flex">
                <div class="ms-3 text-sm font-normal">
                    <div class="mb-2 text-lg font-normal">
                        {{ session()->get('message') }}
                    </div>
                </div>
                <button type="button"
                    class="ms-auto -mx-1.5 -my-1.5 bg-white justify-center items-center flex-shrink-0 text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
                    data-dismiss-target="#toast-message-cta" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>
        </div>
    @endif

    @php
        $message = session()->get('message');
        $buttonColor = '#ffcc00';
    @endphp
    @if (session()->has('message'))
        <script>
            Swal.fire({
                icon: 'info',
                text: '{{ $message }}',

                customClass: {
                    confirmButton: 'custom-swal-button' // Utilisez votre classe CSS personnalisée ici
                }
            });
        </script>
    @endif
    <style>
        /* CSS */
        .custom-swal-button {
            background-color: #ffcc00;
            /* Couleur de fond */
            color: white;
            /* Couleur du texte */
            /* Bordure */
            /* Coins arrondis */
            padding: 10px 20px;
            /* Remplissage intérieur */
            font-size: 16px;
            /* Taille de police */
            font-weight: bold;
            /* Gras */
        }

        .custom-swal-button:hover {
            background-color: #e6b800;
            /* Couleur de fond au survol */
            border-color: #e6b800;
            /* Bordure au survol */
            color: #222;
            /* Couleur du texte au survol */
        }
    </style>
