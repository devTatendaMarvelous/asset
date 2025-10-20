import 'package:get/get.dart';
import '../views/login_view.dart';
import '../views/dashboard_view.dart';
import '../views/scan_view.dart';
import '../views/clock_view.dart';
import '../controllers/auth_controller.dart';
import '../controllers/dashboard_controller.dart';
import '../controllers/scan_controller.dart';
import '../controllers/clock_controller.dart';

class AppRoutes {
  static const String login = '/login';
  static const String dashboard = '/dashboard';
  static const String scan = '/scan';
  static const String clock = '/clock';

  static List<GetPage> routes = [
    GetPage(
      name: login,
      page: () => LoginView(),
      binding: BindingsBuilder(() {
        Get.lazyPut(() => AuthController());
      }),
    ),
    GetPage(
      name: dashboard,
      page: () => DashboardView(),
      binding: BindingsBuilder(() {
        Get.lazyPut(() => DashboardController());
      }),
    ),
    GetPage(
      name: scan,
      page: () => ScanView(),
      binding: BindingsBuilder(() {
        Get.lazyPut(() => ScanController());
      }),
    ),
    GetPage(
      name: clock,
      page: () => ClockView(),
      binding: BindingsBuilder(() {
        Get.lazyPut(() => ClockController());
      }),
    ),
  ];
}