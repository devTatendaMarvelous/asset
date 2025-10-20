import 'package:get/get.dart';
import 'package:mobile_scanner/mobile_scanner.dart';
import '../services/asset_service.dart';
import '../routes/app_routes.dart';
import '../models/scan_response.dart';

class ScanController extends GetxController {
  final AssetService _assetService = AssetService();

  late MobileScannerController cameraController;

  final RxBool isScanning = true.obs;
  final RxBool isLoading = false.obs;
  final Rx<AssetData?> scannedAsset = Rx<AssetData?>(null);

  @override
  void onInit() {
    super.onInit();
    cameraController = MobileScannerController(
      detectionSpeed: DetectionSpeed.normal,
      facing: CameraFacing.back,
      torchEnabled: false,
    );
  }

  // Handle scanned QR code
  Future<void> handleScan(BarcodeCapture barcodeCapture) async {
    if (!isScanning.value) return;

    final List<Barcode> barcodes = barcodeCapture.barcodes;

    if (barcodes.isEmpty) return;

    final String? code = barcodes.first.rawValue;

    if (code == null || code.isEmpty) return;

    try {
      isScanning.value = false;
      isLoading.value = true;

      final response = await _assetService.scanAsset(code);

      if (response.success && response.data != null) {
        scannedAsset.value = response.data;

        Get.snackbar(
          'Success',
          response.message,
          snackPosition: SnackPosition.BOTTOM,
        );

        // Navigate to clock view with asset data
        Get.toNamed(AppRoutes.clock, arguments: {
          'asset': response.data,
        });
      } else {
        Get.snackbar(
          'Error',
          response.message.isNotEmpty ? response.message : 'Asset not found',
          snackPosition: SnackPosition.BOTTOM,
        );
        isScanning.value = true;
      }
    } catch (e) {
      Get.snackbar(
        'Error',
        e.toString(),
        snackPosition: SnackPosition.BOTTOM,
      );
      isScanning.value = true;
    } finally {
      isLoading.value = false;
    }
  }

  // Reset scanner
  void resetScanner() {
    isScanning.value = true;
    scannedAsset.value = null;
  }

  // Toggle flash
  void toggleFlash() {
    cameraController.toggleTorch();
  }

  // Switch camera
  void switchCamera() {
    cameraController.switchCamera();
  }

  @override
  void onClose() {
    cameraController.dispose();
    super.onClose();
  }
}