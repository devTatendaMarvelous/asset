import 'package:get/get.dart';
import '../routes/app_routes.dart';

class DashboardController extends GetxController {
  final RxString userName = 'User'.obs;
  final RxString currentDate = ''.obs;
  final RxString currentTime = ''.obs;

  @override
  void onInit() {
    super.onInit();
    _updateDateTime();
    // Update time every second
    Future.delayed(const Duration(seconds: 1), _updateDateTime);
  }

  void _updateDateTime() {
    final now = DateTime.now();
    currentDate.value = _formatDate(now);
    currentTime.value = _formatTime(now);

    // Schedule next update
    Future.delayed(const Duration(seconds: 1), _updateDateTime);
  }

  String _formatDate(DateTime date) {
    const months = [
      'January', 'February', 'March', 'April', 'May', 'June',
      'July', 'August', 'September', 'October', 'November', 'December'
    ];
    return '${date.day} ${months[date.month - 1]} ${date.year}';
  }

  String _formatTime(DateTime time) {
    final hour = time.hour.toString().padLeft(2, '0');
    final minute = time.minute.toString().padLeft(2, '0');
    return '$hour:$minute';
  }

  void navigateToScan() {
    Get.toNamed(AppRoutes.scan);
  }

  void showProfile() {
    Get.snackbar(
      'Profile',
      'Profile feature coming soon',
      snackPosition: SnackPosition.BOTTOM,
    );
  }

  void showSettings() {
    Get.snackbar(
      'Settings',
      'Settings feature coming soon',
      snackPosition: SnackPosition.BOTTOM,
    );
  }

  void showHistory() {
    Get.snackbar(
      'History',
      'History feature coming soon',
      snackPosition: SnackPosition.BOTTOM,
    );
  }
}