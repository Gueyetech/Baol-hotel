@php
    $message = session()->get('message');
    $buttonColor = '#ffcc00';
@endphp
@if ($message)
    <script>
        Swal.fire({
            icon: 'info',
            text: '{{ $message }}',

            customClass: {
                confirmButton: 'custom-swal-button'  // Utilisez votre classe CSS personnalisée ici
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
