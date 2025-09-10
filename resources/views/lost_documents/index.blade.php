@extends('layouts.app')
@section('content')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Lost Documents</h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <button onclick="openAddModal()" class="bg-blue-500 text-white px-4 py-2 rounded mb-4">Add Lost Document</button>

        @if (session('success'))
            <div class="bg-green-200 text-green-800 p-2 rounded mb-4">{{ session('success') }}</div>
        @endif

        <table class="table-auto w-full bg-white shadow rounded">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-4 py-2">#</th>
                    <th class="px-4 py-2">Type</th>
                    <th class="px-4 py-2">Owner</th>
                    <th class="px-4 py-2">Location</th>
                    <th class="px-4 py-2">Date Lost</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($documents as $doc)
                    <tr class="text-center border-t">
                        <td class="px-4 py-2">{{ $loop->iteration }}</td>
                        <td class="px-4 py-2">{{ $doc->document_type }}</td>
                        <td class="px-4 py-2">{{ $doc->owner_name }}</td>
                        <td class="px-4 py-2">{{ $doc->location_lost }}</td>
                        <td class="px-4 py-2">{{ $doc->date_lost }}</td>
                        <td class="px-4 py-2 space-x-2">
                            <button onclick="openEditModal({{ $doc }})" class="bg-yellow-400 px-2 py-1 rounded">Edit</button>
                            <form action="{{ route('lost-documents.destroy', $doc->id) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button onclick="return confirm('Are you sure?')" class="bg-red-500 text-white px-2 py-1 rounded">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Add Modal -->
    <div id="addModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex justify-center items-center z-50">
        <div class="bg-white p-6 rounded shadow w-full max-w-lg">
            <h3 class="text-xl font-bold mb-4">Add Lost Document</h3>
            <form action="{{ route('lost-documents.store') }}" method="POST">
                @csrf
                <x-text-input label="Document Type" name="document_type" required />
                <x-text-input label="Owner Name" name="owner_name" required />
                <x-text-input label="Location Lost" name="location_lost" required />
                <x-text-input label="Date Lost" name="date_lost" type="date" required />
                <x-textarea label="Description" name="description" />
                <div class="mt-4 flex justify-end space-x-2">
                    <button type="button" onclick="closeAddModal()" class="px-4 py-2 bg-gray-300 rounded">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Save</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Modal -->
    <div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex justify-center items-center z-50">
        <div class="bg-white p-6 rounded shadow w-full max-w-lg">
            <h3 class="text-xl font-bold mb-4">Edit Document</h3>
            <form id="editForm" method="POST">
                @csrf @method('PUT')
                <x-text-input label="Document Type" name="document_type" id="edit_type" required />
                <x-text-input label="Owner Name" name="owner_name" id="edit_owner" required />
                <x-text-input label="Location Lost" name="location_lost" id="edit_location" required />
                <x-text-input label="Date Lost" name="date_lost" type="date" id="edit_date" required />
                <x-textarea label="Description" name="description" id="edit_description" />
                <div class="mt-4 flex justify-end space-x-2">
                    <button type="button" onclick="closeEditModal()" class="px-4 py-2 bg-gray-300 rounded">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded">Update</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openAddModal() {
            document.getElementById('addModal').classList.remove('hidden');
        }

        function closeAddModal() {
            document.getElementById('addModal').classList.add('hidden');
        }

        function openEditModal(doc) {
            document.getElementById('editModal').classList.remove('hidden');
            document.getElementById('edit_type').value = doc.document_type;
            document.getElementById('edit_owner').value = doc.owner_name;
            document.getElementById('edit_location').value = doc.location_lost;
            document.getElementById('edit_date').value = doc.date_lost;
            document.getElementById('edit_description').value = doc.description;
            document.getElementById('editForm').action = `/lost-documents/${doc.id}`;
        }

        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
        }
    </script>
@endsection
