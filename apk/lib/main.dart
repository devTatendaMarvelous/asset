import 'package:flutter/material.dart';
import 'package:get/get.dart';
import 'package:get_storage/get_storage.dart';
import 'config/app_theme.dart';
import 'routes/app_routes.dart';
import 'services/storage_service.dart';
import 'controllers/auth_controller.dart';

void main() async {
  WidgetsFlutterBinding.ensureInitialized();

  // Initialize GetStorage
  await GetStorage.init();

  runApp(const MyApp());
}

class MyApp extends StatelessWidget {
  const MyApp({Key? key}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    // Initialize AuthController
    Get.put(AuthController());

    // Check if user is logged in
    final authController = Get.find<AuthController>();
    final initialRoute = authController.isLoggedIn()
        ? AppRoutes.dashboard
        : AppRoutes.login;

    return GetMaterialApp(
      title: 'Asset Management System',
      theme: AppTheme.lightTheme,
      initialRoute: initialRoute,
      getPages: AppRoutes.routes,
      debugShowCheckedModeBanner: false,
    );
  }
}