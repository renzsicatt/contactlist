<div class="position-relative p-5">
    <style>
        .custom-modal {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgb(0, 0, 0, 0.5);
            z-index: 100;
            display: none !important;
        }

        .modal-container {
            min-height: 30dvh;
            min-width: 30dvh;
            background-color: white;
        }

        .custom-modal.show {
            display: block !important;
        }
    </style>

    <div class="center">
        <h3>RESTORE CONTACT </h>
    </div>


    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Contact Number</th>
                <th scope="col">Address</th>
                <th scope="col">Notes</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($contacts as $contact)
            <tr>
                <td>{{ $contact->name }}</td>
                <td>{{ $contact->email }}</td>
                <td>{{ $contact->contactnumber }}</td>
                <td>{{ $contact->address }}</td>
                <td>{{ $contact->notes }}</td>
                <td>
                    <button class="btn btn-primary" data-contact-id="{{ $contact->id }}">RESTORE</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    @livewireStyles
    <style>
        .custom-modal {
            display: none;
        }
    </style>


    <script src="/socket.io/socket.io.js"></script>
    <script>
        document.querySelector('tbody').addEventListener('click', function(event) {
            if (event.target.classList.contains('btn-primary')) {
                const contactId = event.target.getAttribute('data-contact-id');
                console.log('Deleting contact with ID:', contactId);


                Swal.fire({
                    title: 'Are you sure you want to Restore this Contact?',
                    showDenyButton: true,
                    confirmButtonText: 'Yes',
                    denyButtonText: 'No',
                    customClass: {
                        actions: 'my-actions',
                        cancelButton: 'order-1 right-gap',
                        confirmButton: 'order-2',
                        denyButton: 'order-3',
                    },
                }).then((result) => {
                    if (result.isConfirmed) {
                        const componentId = event.target.closest('[wire\\:id]').getAttribute('wire:id');
                        Livewire.find(componentId).RestoreContact(contactId);
                    }
                })

            }
        });
    </script>