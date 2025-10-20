import 'package:get/get.dart';
import '../services/asset_service.dart';
import '../routes/app_routes.dart';

class ClockController extends GetxController {
  final AssetService _assetService = AssetService();

  final RxBool isLoading = false.obs;
  final RxBool isReporting = false.obs;

  // Clock in (action: IN)
  Future<void> clockIn(int assetId) async {
    try {
      isLoading.value = true;

      final response = await _assetService.clockAsset(
        assetId: assetId,
        action: 'IN',
      );

      if (response.success) {
        Get.snackbar(
          'Success',
          response.message.isNotEmpty ? response.message : 'Clocked in successfully',
          snackPosition: SnackPosition.BOTTOM,
          duration: const Duration(seconds: 2),
        );

        // Delay navigation slightly to show success message
        await Future.delayed(const Duration(milliseconds: 500));
        Get.offAllNamed(AppRoutes.dashboard); // Return to dashboard
      } else {
        Get.snackbar(
          'Error',
          response.message,
          snackPosition: SnackPosition.BOTTOM,
        );
      }
    } catch (e) {
      Get.snackbar(
        'Error',
        e.toString(),
        snackPosition: SnackPosition.BOTTOM,
      );
    } finally {
      isLoading.value = false;
    }
  }

  // Clock out (action: OUT)
  Future<void> clockOut(int assetId) async {
    try {
      isLoading.value = true;

      final response = await _assetService.clockAsset(
        assetId: assetId,
        action: 'OUT',
      );

      if (response.success) {
        Get.snackbar(
          'Success',
          response.message.isNotEmpty ? response.message : 'Clocked out successfully',
          snackPosition: SnackPosition.BOTTOM,
          duration: const Duration(seconds: 2),
        );

        // Delay navigation slightly to show success message
        await Future.delayed(const Duration(milliseconds: 500));
        Get.offAllNamed(AppRoutes.dashboard); // Return to dashboard
      } else {
        Get.snackbar(
          'Error',
          response.message,
          snackPosition: SnackPosition.BOTTOM,
        );
      }
    } catch (e) {
      Get.snackbar(
        'Error',
        e.toString(),
        snackPosition: SnackPosition.BOTTOM,
      );
    } finally {
      isLoading.value = false;
    }
  }
  Future<void> reportFound({
    required int assetId,
    required String notes,
  }) async {
    try {
      isReporting.value = true;
      await _assetService.reportFound(
        assetId: assetId,
        notes: notes,
      );
    } catch (e) {
      rethrow;
    } finally {
      isReporting.value = false;
    }
  }
}