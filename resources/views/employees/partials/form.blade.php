<div class="mb-4">
    <label>Name</label>
    <input type="text" name="name" value="{{ old('name', $employee->name ?? '') }}" class="form-input w-full" required>
</div>

<div class="mb-4">
    <label>Email</label>
    <input type="email" name="email" value="{{ old('email', $employee->email ?? '') }}" class="form-input w-full" required>
</div>

<div class="mb-4">
    <label>Position</label>
    <input type="text" name="position" value="{{ old('position', $employee->position ?? '') }}" class="form-input w-full">
</div>

<div class="mb-4">
    <label>Phone</label>
    <input type="text" name="phone" value="{{ old('phone', $employee->phone ?? '') }}" class="form-input w-full">
</div>

<div class="mb-4">
    <label>Date Joined</label>
    <input type="date" name="date_joined" value="{{ old('date_joined', $employee->date_joined ?? '') }}" class="form-input w-full">
</div>