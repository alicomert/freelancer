<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserEducation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class EducationController extends Controller
{
    /**
     * Store a newly created education in storage.
     */
    public function store(Request $request)
    {
        try {
            // Validate the request
            $validator = Validator::make($request->all(), [
                'education_name' => 'required|string|max:255',
                'institution' => 'required|string|max:255',
                'start_year' => 'required|integer|min:1950|max:2030',
                'end_year' => 'nullable|integer|min:1950|max:2030|gte:start_year',
                'document_link' => 'nullable|url|max:500'
            ], [
                'education_name.required' => 'Eğitim adı zorunludur.',
                'education_name.max' => 'Eğitim adı en fazla 255 karakter olabilir.',
                'institution.required' => 'Kurum adı zorunludur.',
                'institution.max' => 'Kurum adı en fazla 255 karakter olabilir.',
                'start_year.required' => 'Başlangıç yılı zorunludur.',
                'start_year.integer' => 'Başlangıç yılı sayı olmalıdır.',
                'start_year.min' => 'Başlangıç yılı 1950\'den küçük olamaz.',
                'start_year.max' => 'Başlangıç yılı 2030\'dan büyük olamaz.',
                'end_year.integer' => 'Bitiş yılı sayı olmalıdır.',
                'end_year.min' => 'Bitiş yılı 1950\'den küçük olamaz.',
                'end_year.max' => 'Bitiş yılı 2030\'dan büyük olamaz.',
                'end_year.gte' => 'Bitiş yılı başlangıç yılından küçük olamaz.',
                'document_link.url' => 'Geçerli bir URL giriniz.',
                'document_link.max' => 'Belge linki en fazla 500 karakter olabilir.'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validator->errors()->first()
                ], 422);
            }

            // Check if user has reached the maximum education limit (optional)
            $userEducationCount = UserEducation::where('user_id', Auth::id())->count();
            if ($userEducationCount >= 20) { // Maximum 20 educations per user
                return response()->json([
                    'success' => false,
                    'message' => 'En fazla 20 eğitim bilgisi ekleyebilirsiniz.'
                ], 422);
            }

            // Get the next sort order
            $nextSortOrder = UserEducation::where('user_id', Auth::id())->max('sort_order') + 1;

            // Sanitize input data
            $educationData = [
                'user_id' => Auth::id(),
                'education_name' => strip_tags(trim($request->education_name)),
                'institution' => strip_tags(trim($request->institution)),
                'start_year' => (int) $request->start_year,
                'end_year' => $request->end_year ? (int) $request->end_year : null,
                'document_link' => $request->document_link ? filter_var(trim($request->document_link), FILTER_SANITIZE_URL) : null,
                'link_access' => $request->document_link ? 0 : 1, // 0 = onay bekliyor (belge varsa), 1 = onaylandı (belge yoksa)
                'sort_order' => $nextSortOrder
            ];

            // Create the education record
            $education = UserEducation::create($educationData);

            Log::info('Education created successfully', [
                'user_id' => Auth::id(),
                'education_id' => $education->id,
                'education_name' => $education->education_name
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Eğitim bilgisi başarıyla eklendi.',
                'data' => $education
            ], 201);

        } catch (\Exception $e) {
            Log::error('Error creating education', [
                'user_id' => Auth::id(),
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Bir hata oluştu. Lütfen tekrar deneyin.'
            ], 500);
        }
    }

    /**
     * Remove the specified education from storage.
     */
    public function destroy($id)
    {
        try {
            // Find the education record
            $education = UserEducation::where('id', $id)
                                    ->where('user_id', Auth::id())
                                    ->first();

            if (!$education) {
                return response()->json([
                    'success' => false,
                    'message' => 'Eğitim bilgisi bulunamadı veya silme yetkiniz yok.'
                ], 404);
            }

            // Store education info for logging
            $educationInfo = [
                'id' => $education->id,
                'education_name' => $education->education_name,
                'institution' => $education->institution
            ];

            // Delete the education
            $education->delete();

            Log::info('Education deleted successfully', [
                'user_id' => Auth::id(),
                'education_info' => $educationInfo
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Eğitim bilgisi başarıyla silindi.'
            ], 200);

        } catch (\Exception $e) {
            Log::error('Error deleting education', [
                'user_id' => Auth::id(),
                'education_id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Silme işlemi sırasında bir hata oluştu.'
            ], 500);
        }
    }

    /**
     * Show the specified education for editing.
     */
    public function show($id)
    {
        try {
            $education = UserEducation::where('id', $id)
                                    ->where('user_id', Auth::id())
                                    ->first();

            if (!$education) {
                return response()->json([
                    'success' => false,
                    'message' => 'Eğitim bilgisi bulunamadı.'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'data' => $education
            ], 200);

        } catch (\Exception $e) {
            Log::error('Error fetching education', [
                'user_id' => Auth::id(),
                'education_id' => $id,
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Bir hata oluştu.'
            ], 500);
        }
    }

    /**
     * Update the specified education in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            // Find the education record
            $education = UserEducation::where('id', $id)
                                    ->where('user_id', Auth::id())
                                    ->first();

            if (!$education) {
                return response()->json([
                    'success' => false,
                    'message' => 'Eğitim bilgisi bulunamadı veya güncelleme yetkiniz yok.'
                ], 404);
            }

            // Validate the request
            $validator = Validator::make($request->all(), [
                'education_name' => 'required|string|max:255',
                'institution' => 'required|string|max:255',
                'start_year' => 'required|integer|min:1950|max:2030',
                'end_year' => 'nullable|integer|min:1950|max:2030|gte:start_year',
                'document_link' => 'nullable|url|max:500'
            ], [
                'education_name.required' => 'Eğitim adı zorunludur.',
                'education_name.max' => 'Eğitim adı en fazla 255 karakter olabilir.',
                'institution.required' => 'Kurum adı zorunludur.',
                'institution.max' => 'Kurum adı en fazla 255 karakter olabilir.',
                'start_year.required' => 'Başlangıç yılı zorunludur.',
                'start_year.integer' => 'Başlangıç yılı sayı olmalıdır.',
                'start_year.min' => 'Başlangıç yılı 1950\'den küçük olamaz.',
                'start_year.max' => 'Başlangıç yılı 2030\'dan büyük olamaz.',
                'end_year.integer' => 'Bitiş yılı sayı olmalıdır.',
                'end_year.min' => 'Bitiş yılı 1950\'den küçük olamaz.',
                'end_year.max' => 'Bitiş yılı 2030\'dan büyük olamaz.',
                'end_year.gte' => 'Bitiş yılı başlangıç yılından küçük olamaz.',
                'document_link.url' => 'Geçerli bir URL giriniz.',
                'document_link.max' => 'Belge linki en fazla 500 karakter olabilir.'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validator->errors()->first()
                ], 422);
            }

            // Store old document link to check if it changed
            $oldDocumentLink = $education->document_link;
            $newDocumentLink = $request->document_link ? filter_var(trim($request->document_link), FILTER_SANITIZE_URL) : null;

            // Prepare update data
            $updateData = [
                'education_name' => strip_tags(trim($request->education_name)),
                'institution' => strip_tags(trim($request->institution)),
                'start_year' => (int) $request->start_year,
                'end_year' => $request->end_year ? (int) $request->end_year : null,
                'document_link' => $newDocumentLink
            ];

            // If document link changed, reset link_access to 0 (pending)
            if ($oldDocumentLink !== $newDocumentLink) {
                $updateData['link_access'] = $newDocumentLink ? 0 : 1;
            }

            // Update the education record
            $education->update($updateData);

            Log::info('Education updated successfully', [
                'user_id' => Auth::id(),
                'education_id' => $education->id,
                'education_name' => $education->education_name,
                'document_link_changed' => $oldDocumentLink !== $newDocumentLink
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Eğitim bilgisi başarıyla güncellendi.',
                'data' => $education->fresh()
            ], 200);

        } catch (\Exception $e) {
            Log::error('Error updating education', [
                'user_id' => Auth::id(),
                'education_id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Güncelleme işlemi sırasında bir hata oluştu.'
            ], 500);
        }
    }

    /**
     * Update the sort order of educations.
     */
    public function updateOrder(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'educations' => 'required|array',
                'educations.*.id' => 'required|integer|exists:user_educations,id',
                'educations.*.sort_order' => 'required|integer|min:0'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validator->errors()->first()
                ], 422);
            }

            foreach ($request->educations as $educationData) {
                UserEducation::where('id', $educationData['id'])
                           ->where('user_id', Auth::id())
                           ->update(['sort_order' => $educationData['sort_order']]);
            }

            Log::info('Education order updated successfully', [
                'user_id' => Auth::id(),
                'education_count' => count($request->educations)
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Sıralama başarıyla güncellendi.'
            ], 200);

        } catch (\Exception $e) {
            Log::error('Error updating education order', [
                'user_id' => Auth::id(),
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Sıralama güncellenirken bir hata oluştu.'
            ], 500);
        }
    }
}
