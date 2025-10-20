import 'package:asset_manage/routes/app_routes.dart';
import 'package:flutter/material.dart';
import 'package:get/get.dart';
import '../controllers/clock_controller.dart';
import '../models/scan_response.dart';
import '../config/app_theme.dart';

class ClockView extends StatelessWidget {
  final ClockController controller = Get.find<ClockController>();

  ClockView({Key? key}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    final arguments = Get.arguments as Map<String, dynamic>;
    final AssetData asset = arguments['asset'];
    final bool isAssigned = asset.status.toUpperCase() == 'ASSIGNED';

    return Scaffold(
      extendBodyBehindAppBar: true,
      appBar: AppBar(
        title: const Text('Clock Action'),
        elevation: 0,
        backgroundColor: Colors.transparent,
        foregroundColor: AppTheme.charcoalBlack,
      ),
      body: Container(
        decoration: const BoxDecoration(
          gradient: AppTheme.backgroundGradient,
        ),
        child: SafeArea(
          child: SingleChildScrollView(
            padding: const EdgeInsets.all(24.0),
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.stretch,
              children: [
                // Enhanced Success Icon with Animation
                TweenAnimationBuilder<double>(
                  tween: Tween(begin: 0.0, end: 1.0),
                  duration: const Duration(milliseconds: 600),
                  curve: Curves.elasticOut,
                  builder: (context, scale, child) {
                    return Transform.scale(
                      scale: scale,
                      child: child,
                    );
                  },
                  child: Container(
                    padding: const EdgeInsets.all(24),
                    decoration: BoxDecoration(
                      gradient: LinearGradient(
                        colors: [
                          Colors.green.shade400,
                          Colors.green.shade600,
                        ],
                        begin: Alignment.topLeft,
                        end: Alignment.bottomRight,
                      ),
                      shape: BoxShape.circle,
                      boxShadow: [
                        BoxShadow(
                          color: Colors.green.withValues(alpha: 0.4),
                          blurRadius: 24,
                          offset: const Offset(0, 12),
                          spreadRadius: 2,
                        ),
                      ],
                    ),
                    child: Container(
                      padding: const EdgeInsets.all(16),
                      decoration: BoxDecoration(
                        color: Colors.white.withOpacity(0.2),
                        shape: BoxShape.circle,
                      ),
                      child: const Icon(
                        Icons.check_circle_rounded,
                        size: 56,
                        color: Colors.white,
                      ),
                    ),
                  ),
                ),
                const SizedBox(height: 24),

                Text(
                  'Asset Scanned Successfully',
                  style: Theme.of(context).textTheme.headlineMedium?.copyWith(
                    fontWeight: FontWeight.bold,
                    letterSpacing: -0.5,
                  ),
                  textAlign: TextAlign.center,
                ),
                const SizedBox(height: 8),
                Text(
                  'Review the details below',
                  style: Theme.of(context).textTheme.bodyMedium?.copyWith(
                    color: AppTheme.textSecondary,
                  ),
                  textAlign: TextAlign.center,
                ),
                const SizedBox(height: 32),

                // Enhanced Status Chips Row
                Column(
                  spacing: 8,
                  mainAxisAlignment: MainAxisAlignment.center,
                  children: [
                    _buildEnhancedAssetTypeChip(asset.type?.name ?? 'N/A'),
                    const SizedBox(width: 12),
                    _buildEnhancedStatusChip(asset.status),
                  ],
                ),
                const SizedBox(height: 24),

                // Enhanced Asset Details Card
                _buildEnhancedCard(
                  context,
                  title: 'Asset Details',
                  icon: Icons.inventory_2_rounded,
                  iconColor: AppTheme.secondaryBlue,
                  children: [
                    _buildEnhancedDetailRow(
                      context,
                      icon: Icons.tag_rounded,
                      label: 'Asset ID',
                      value: '#${asset.id}',
                      iconColor: AppTheme.primaryGold,
                    ),
                    const SizedBox(height: 16),
                    _buildEnhancedDetailRow(
                      context,
                      icon: Icons.laptop_rounded,
                      label: 'Brand',
                      value: asset.brand,
                      iconColor: AppTheme.secondaryBlue,
                    ),
                    const SizedBox(height: 16),
                    _buildEnhancedDetailRow(
                      context,
                      icon: Icons.pin_rounded,
                      label: 'Serial Number',
                      value: asset.serialNumber,
                      iconColor: AppTheme.accentRed,
                    ),
                    const SizedBox(height: 16),
                    _buildEnhancedDetailRow(
                      context,
                      icon: Icons.description_rounded,
                      label: 'Description',
                      value: asset.description,
                      iconColor: Colors.purple,
                    ),
                  ],
                ),
                const SizedBox(height: 16),

                // Enhanced Assigned User Card
                if (asset.user != null)
                  _buildEnhancedCard(
                    context,
                    title: 'Owner Details',
                    icon: Icons.person_rounded,
                    iconColor: AppTheme.primaryGold,
                    children: [
                      _buildEnhancedDetailRow(
                        context,
                        icon: Icons.badge_rounded,
                        label: 'Name',
                        value: asset.user!.name,
                        iconColor: AppTheme.secondaryBlue,
                      ),
                      const SizedBox(height: 16),
                      _buildEnhancedDetailRow(
                        context,
                        icon: Icons.school_rounded,
                        label: 'Reg Number',
                        value: asset.user!.regNumber,
                        iconColor: AppTheme.primaryGold,
                      ),
                      const SizedBox(height: 16),
                      _buildEnhancedDetailRow(
                        context,
                        icon: Icons.email_rounded,
                        label: 'Email',
                        value: asset.user!.email,
                        iconColor: AppTheme.accentRed,
                      ),
                      if (asset.user!.phone != null) ...[
                        const SizedBox(height: 16),
                        _buildEnhancedDetailRow(
                          context,
                          icon: Icons.phone_rounded,
                          label: 'Phone',
                          value: asset.user!.phone!,
                          iconColor: Colors.green,
                        ),
                      ],
                    ],
                  ),
                const SizedBox(height: 32),

                // Conditional Content based on status
                if (isAssigned) ...[
                  // Enhanced Question Section
                  Container(
                    padding: const EdgeInsets.all(20),
                    decoration: BoxDecoration(
                      gradient: LinearGradient(
                        colors: [
                          AppTheme.lightBlue,
                          AppTheme.lightBlue.withOpacity(0.5),
                        ],
                      ),
                      borderRadius: BorderRadius.circular(20),
                      border: Border.all(
                        color: AppTheme.secondaryBlue.withOpacity(0.3),
                        width: 1,
                      ),
                    ),
                    child: Text(
                      'What would you like to do?',
                      style: Theme.of(context).textTheme.titleLarge?.copyWith(
                        fontWeight: FontWeight.bold,
                        color: AppTheme.secondaryBlue,
                      ),
                      textAlign: TextAlign.center,
                    ),
                  ),
                  const SizedBox(height: 24),

                  // Enhanced Clock In button
                  Obx(() => _buildEnhancedActionButton(
                    context,
                    icon: Icons.login_rounded,
                    label: 'Clock In',
                    gradient: LinearGradient(
                      colors: [Colors.green.shade400, Colors.green.shade600],
                    ),
                    onPressed: controller.isLoading.value
                        ? null
                        : () => controller.clockIn(asset.id),
                    isLoading: controller.isLoading.value,
                  )),
                  const SizedBox(height: 16),

                  // Enhanced Clock Out button
                  Obx(() => _buildEnhancedActionButton(
                    context,
                    icon: Icons.logout_rounded,
                    label: 'Clock Out',
                    gradient: LinearGradient(
                      colors: [AppTheme.accentRed, AppTheme.accentRed.withOpacity(0.8)],
                    ),
                    onPressed: controller.isLoading.value
                        ? null
                        : () => controller.clockOut(asset.id),
                    isLoading: controller.isLoading.value,
                  )),
                ] else ...[
                  // Enhanced Report Found Card
                  Container(
                    decoration: BoxDecoration(
                      gradient: LinearGradient(
                        colors: [
                          AppTheme.secondaryBlue.withOpacity(0.1),
                          AppTheme.lightBlue,
                        ],
                        begin: Alignment.topLeft,
                        end: Alignment.bottomRight,
                      ),
                      borderRadius: BorderRadius.circular(24),
                      border: Border.all(
                        color: AppTheme.secondaryBlue.withOpacity(0.3),
                        width: 2,
                      ),
                      boxShadow: [
                        BoxShadow(
                          color: AppTheme.secondaryBlue.withOpacity(0.1),
                          blurRadius: 15,
                          offset: const Offset(0, 8),
                        ),
                      ],
                    ),
                    child: Padding(
                      padding: const EdgeInsets.all(28.0),
                      child: Column(
                        children: [
                          Container(
                            padding: const EdgeInsets.all(16),
                            decoration: BoxDecoration(
                              color: AppTheme.secondaryBlue.withOpacity(0.15),
                              shape: BoxShape.circle,
                            ),
                            child: Icon(
                              Icons.info_rounded,
                              size: 48,
                              color: AppTheme.secondaryBlue,
                            ),
                          ),
                          const SizedBox(height: 20),
                          Text(
                            'Report Found',
                            style: Theme.of(context).textTheme.headlineSmall?.copyWith(
                              color: AppTheme.secondaryBlue,
                              fontWeight: FontWeight.bold,
                              letterSpacing: -0.5,
                            ),
                            textAlign: TextAlign.center,
                          ),
                          const SizedBox(height: 12),
                          Text(
                            'This asset is not assigned. You can report it as found to notify admins.',
                            style: Theme.of(context).textTheme.bodyMedium?.copyWith(
                              color: AppTheme.charcoalBlack.withOpacity(0.7),
                              height: 1.5,
                            ),
                            textAlign: TextAlign.center,
                          ),
                          const SizedBox(height: 24),
                          _buildEnhancedActionButton(
                            context,
                            icon: Icons.report_rounded,
                            label: 'Report Found',
                            gradient: LinearGradient(
                              colors: [AppTheme.secondaryBlue, AppTheme.secondaryBlue.withOpacity(0.8)],
                            ),
                            onPressed: () => _showReportFoundSheet(context, asset.id),
                            isLoading: false,
                          ),
                        ],
                      ),
                    ),
                  ),
                ],
                const SizedBox(height: 24),

                // Enhanced Cancel button
                OutlinedButton(
                  onPressed: () => Get.offAllNamed(AppRoutes.dashboard),
                  style: OutlinedButton.styleFrom(
                    padding: const EdgeInsets.symmetric(vertical: 18),
                    side: BorderSide(
                      color: AppTheme.textSecondary.withOpacity(0.5),
                      width: 2,
                    ),
                    shape: RoundedRectangleBorder(
                      borderRadius: BorderRadius.circular(16),
                    ),
                  ),
                  child: Text(
                    isAssigned ? 'Cancel' : 'Back to Dashboard',
                    style: const TextStyle(
                      fontSize: 16,
                      fontWeight: FontWeight.w600,
                    ),
                  ),
                ),

                // Loading indicator
                Obx(() => controller.isLoading.value
                    ? Padding(
                  padding: const EdgeInsets.only(top: 24),
                  child: Center(
                    child: Column(
                      children: [
                        CircularProgressIndicator(
                          color: AppTheme.secondaryBlue,
                        ),
                        const SizedBox(height: 12),
                        Text(
                          'Processing...',
                          style: TextStyle(
                            color: AppTheme.textSecondary,
                            fontWeight: FontWeight.w500,
                          ),
                        ),
                      ],
                    ),
                  ),
                )
                    : const SizedBox.shrink()),
                const SizedBox(height: 24),
              ],
            ),
          ),
        ),
      ),
    );
  }

  Widget _buildEnhancedCard(
      BuildContext context, {
        required String title,
        required IconData icon,
        required Color iconColor,
        required List<Widget> children,
      }) {
    return Container(
      decoration: BoxDecoration(
        color: Colors.white,
        borderRadius: BorderRadius.circular(24),
        boxShadow: [
          BoxShadow(
            color: AppTheme.charcoalBlack.withOpacity(0.06),
            blurRadius: 20,
            offset: const Offset(0, 8),
          ),
        ],
      ),
      child: Padding(
        padding: const EdgeInsets.all(24.0),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            Row(
              children: [
                Container(
                  padding: const EdgeInsets.all(12),
                  decoration: BoxDecoration(
                    gradient: LinearGradient(
                      colors: [
                        iconColor.withOpacity(0.15),
                        iconColor.withOpacity(0.05),
                      ],
                    ),
                    borderRadius: BorderRadius.circular(14),
                  ),
                  child: Icon(
                    icon,
                    color: iconColor,
                    size: 24,
                  ),
                ),
                const SizedBox(width: 14),
                Text(
                  title,
                  style: Theme.of(context).textTheme.titleLarge?.copyWith(
                    fontWeight: FontWeight.bold,
                    letterSpacing: -0.3,
                  ),
                ),
              ],
            ),
            const SizedBox(height: 24),
            ...children,
          ],
        ),
      ),
    );
  }

  Widget _buildEnhancedDetailRow(
      BuildContext context, {
        required IconData icon,
        required String label,
        required String value,
        required Color iconColor,
      }) {
    return Row(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        Container(
          padding: const EdgeInsets.all(8),
          decoration: BoxDecoration(
            color: iconColor.withOpacity(0.1),
            borderRadius: BorderRadius.circular(10),
          ),
          child: Icon(
            icon,
            size: 18,
            color: iconColor,
          ),
        ),
        const SizedBox(width: 14),
        Expanded(
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              Text(
                label,
                style: Theme.of(context).textTheme.bodySmall?.copyWith(
                  color: AppTheme.textSecondary,
                  fontWeight: FontWeight.w500,
                  letterSpacing: 0.3,
                ),
              ),
              const SizedBox(height: 6),
              Text(
                value,
                style: Theme.of(context).textTheme.bodyLarge?.copyWith(
                  fontWeight: FontWeight.w600,
                  letterSpacing: -0.2,
                ),
              ),
            ],
          ),
        ),
      ],
    );
  }

  Widget _buildEnhancedAssetTypeChip(String type) {
    return Container(
      padding: const EdgeInsets.symmetric(horizontal: 20, vertical: 12),
      decoration: BoxDecoration(
        gradient: LinearGradient(
          colors: [
            AppTheme.secondaryBlue,
            AppTheme.secondaryBlue.withOpacity(0.85),
          ],
        ),
        borderRadius: BorderRadius.circular(16),
        boxShadow: [
          BoxShadow(
            color: AppTheme.secondaryBlue.withOpacity(0.3),
            blurRadius: 12,
            offset: const Offset(0, 6),
          ),
        ],
      ),
      child: Row(
        mainAxisSize: MainAxisSize.min,
        children: [
          Icon(
            Icons.devices_rounded,
            color: Colors.white,
            size: 18,
          ),
          const SizedBox(width: 8),
          Text(
            type,
            style: const TextStyle(
              color: Colors.white,
              fontSize: 15,
              fontWeight: FontWeight.bold,
              letterSpacing: 0.3,
            ),
          ),
        ],
      ),
    );
  }

  Widget _buildEnhancedStatusChip(String status) {
    Color statusColor;
    IconData statusIcon;

    switch (status.toUpperCase()) {
      case 'ASSIGNED':
        statusColor = Colors.green;
        statusIcon = Icons.check_circle_rounded;
        break;
      case 'LOST':
        statusColor = Colors.red;
        statusIcon = Icons.inventory_rounded;
        break;
      case 'REPORTED_FOUND':
        statusColor = Colors.deepOrangeAccent;
        statusIcon = Icons.light_sharp;
        break;
      case 'STOLEN':
        statusColor = Colors.orange;
        statusIcon = Icons.build_rounded;
        break;
      default:
        statusColor = AppTheme.textSecondary;
        statusIcon = Icons.help_rounded;
    }

    return Container(
      padding: const EdgeInsets.symmetric(horizontal: 18, vertical: 10),
      decoration: BoxDecoration(
        color: statusColor.withOpacity(0.12),
        border: Border.all(color: statusColor.withOpacity(0.5), width: 2),
        borderRadius: BorderRadius.circular(16),
        boxShadow: [
          BoxShadow(
            color: statusColor.withOpacity(0.15),
            blurRadius: 8,
            offset: const Offset(0, 4),
          ),
        ],
      ),
      child: Row(
        mainAxisSize: MainAxisSize.min,
        children: [
          Icon(
            statusIcon,
            color: statusColor,
            size: 18,
          ),
          const SizedBox(width: 8),
          Text(
            status,
            style: TextStyle(
              color: statusColor,
              fontSize: 14,
              fontWeight: FontWeight.bold,
              letterSpacing: 0.5,
            ),
          ),
        ],
      ),
    );
  }

  Widget _buildEnhancedActionButton(
      BuildContext context, {
        required IconData icon,
        required String label,
        required Gradient gradient,
        required VoidCallback? onPressed,
        required bool isLoading,
      }) {
    return Container(
      decoration: BoxDecoration(
        gradient: onPressed == null ? null : gradient,
        borderRadius: BorderRadius.circular(18),
        color: onPressed == null ? Colors.grey.shade300 : null,
        boxShadow: onPressed == null
            ? null
            : [
          BoxShadow(
            color: gradient.colors.first.withOpacity(0.4),
            blurRadius: 16,
            offset: const Offset(0, 8),
          ),
        ],
      ),
      child: Material(
        color: Colors.transparent,
        child: InkWell(
          onTap: onPressed,
          borderRadius: BorderRadius.circular(18),
          child: Padding(
            padding: const EdgeInsets.symmetric(vertical: 18),
            child: Row(
              mainAxisAlignment: MainAxisAlignment.center,
              children: [
                if (isLoading)
                  const SizedBox(
                    height: 24,
                    width: 24,
                    child: CircularProgressIndicator(
                      strokeWidth: 2.5,
                      color: Colors.white,
                    ),
                  )
                else ...[
                  Icon(icon, size: 26, color: Colors.white),
                  const SizedBox(width: 12),
                  Text(
                    label,
                    style: const TextStyle(
                      fontSize: 18,
                      fontWeight: FontWeight.bold,
                      color: Colors.white,
                      letterSpacing: 0.3,
                    ),
                  ),
                ],
              ],
            ),
          ),
        ),
      ),
    );
  }

  void _showReportFoundSheet(BuildContext context, int assetId) {
    final TextEditingController notesController = TextEditingController();

    showModalBottomSheet<void>(
      context: context,
      isScrollControlled: true,
      backgroundColor: Colors.transparent,
      builder: (ctx) {
        return Container(
          decoration: const BoxDecoration(
            color: Colors.white,
            borderRadius: BorderRadius.vertical(top: Radius.circular(28)),
          ),
          child: Padding(
            padding: EdgeInsets.only(
              bottom: MediaQuery.of(ctx).viewInsets.bottom,
              left: 24,
              right: 24,
              top: 24,
            ),
            child: SingleChildScrollView(
              child: Column(
                mainAxisSize: MainAxisSize.min,
                children: [
                  Container(
                    width: 48,
                    height: 5,
                    decoration: BoxDecoration(
                      color: Colors.grey.shade300,
                      borderRadius: BorderRadius.circular(4),
                    ),
                  ),
                  const SizedBox(height: 24),
                  Container(
                    padding: const EdgeInsets.all(16),
                    decoration: BoxDecoration(
                      color: AppTheme.secondaryBlue.withOpacity(0.1),
                      shape: BoxShape.circle,
                    ),
                    child: Icon(
                      Icons.report_rounded,
                      size: 40,
                      color: AppTheme.secondaryBlue,
                    ),
                  ),
                  const SizedBox(height: 20),
                  Text(
                    'Report Found Asset',
                    style: Theme.of(context).textTheme.headlineSmall?.copyWith(
                      fontWeight: FontWeight.bold,
                      letterSpacing: -0.5,
                    ),
                  ),
                  const SizedBox(height: 12),
                  Text(
                    'Enter notes (optional) about where/how you found the asset.',
                    style: Theme.of(context).textTheme.bodyMedium?.copyWith(
                      color: AppTheme.textSecondary,
                      height: 1.5,
                    ),
                    textAlign: TextAlign.center,
                  ),
                  const SizedBox(height: 24),
                  TextFormField(
                    controller: notesController,
                    maxLines: 5,
                    decoration: InputDecoration(
                      hintText: 'Enter your notes here...',
                      hintStyle: TextStyle(color: Colors.grey.shade400),
                      alignLabelWithHint: true,
                      filled: true,
                      fillColor: AppTheme.lightBlue.withOpacity(0.3),
                      border: OutlineInputBorder(
                        borderRadius: BorderRadius.circular(16),
                        borderSide: BorderSide.none,
                      ),
                      focusedBorder: OutlineInputBorder(
                        borderRadius: BorderRadius.circular(16),
                        borderSide: BorderSide(
                          color: AppTheme.secondaryBlue,
                          width: 2,
                        ),
                      ),
                    ),
                  ),
                  const SizedBox(height: 24),
                  Obx(() => _buildEnhancedActionButton(
                    context,
                    icon: Icons.check_rounded,
                    label: 'Confirm Report',
                    gradient: LinearGradient(
                      colors: [AppTheme.primaryGold, AppTheme.primaryGold.withOpacity(0.85)],
                    ),
                    onPressed: controller.isReporting.value
                        ? null
                        : () async {
                      final notes = notesController.text.trim();
                      try {
                        await controller.reportFound(
                          assetId: assetId,
                          notes: notes,
                        );
                        if (ctx.mounted) Navigator.of(ctx).pop();
                        if (Get.context != null) {
                          Get.to(() => const _FoundSuccessView());
                        }
                      } catch (e) {
                        Get.snackbar(
                          'Error',
                          e.toString(),
                          snackPosition: SnackPosition.BOTTOM,
                          backgroundColor: AppTheme.accentRed.withOpacity(0.9),
                          colorText: Colors.white,
                        );
                      }
                    },
                    isLoading: controller.isReporting.value,
                  )),
                  const SizedBox(height: 32),
                ],
              ),
            ),
          ),
        );
      },
    );
  }
}

class _FoundSuccessView extends StatelessWidget {
  const _FoundSuccessView({Key? key}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      extendBodyBehindAppBar: true,
      appBar: AppBar(
        title: const Text('Report Submitted'),
        elevation: 0,
        backgroundColor: Colors.transparent,
      ),
      body: Container(
        decoration: const BoxDecoration(
          gradient: AppTheme.backgroundGradient,
        ),
        child: SafeArea(
          child: Center(
            child: Padding(
              padding: const EdgeInsets.all(24.0),
              child: Container(
                decoration: BoxDecoration(
                  color: Colors.white,
                  borderRadius: BorderRadius.circular(28),
                  boxShadow: [
                    BoxShadow(
                      color: AppTheme.charcoalBlack.withOpacity(0.1),
                      blurRadius: 24,
                      offset: const Offset(0, 12),
                    ),
                  ],
                ),
                child: Padding(
                  padding: const EdgeInsets.all(32.0),
                  child: Column(
                    mainAxisSize: MainAxisSize.min,
                    children: [
                      TweenAnimationBuilder<double>(
                        tween: Tween(begin: 0.0, end: 1.0),
                        duration: const Duration(milliseconds: 600),
                        curve: Curves.elasticOut,
                        builder: (context, scale, child) {
                          return Transform.scale(scale: scale, child: child);
                        },
                        child: Container(
                          padding: const EdgeInsets.all(20),
                          decoration: BoxDecoration(
                            gradient: LinearGradient(
                              colors: [
                                AppTheme.secondaryBlue.withOpacity(0.15),
                                AppTheme.lightBlue,
                              ],
                            ),
                            shape: BoxShape.circle,
                          ),
                          child: Icon(
                            Icons.check_circle_rounded,
                            color: AppTheme.secondaryBlue,
                            size: 64,
                          ),
                        ),
                      ),
                      const SizedBox(height: 28),
                      Text(
                        'Thank You!',
                        style: Theme.of(context).textTheme.headlineMedium?.copyWith(
                          fontWeight: FontWeight.bold,
                          letterSpacing: -0.5,
                        ),
                      ),
                      const SizedBox(height: 12),
                      Text(
                        'Your report has been submitted successfully. Administrators will be notified.',
                        style: Theme.of(context).textTheme.bodyMedium?.copyWith(
                          color: AppTheme.textSecondary,
                          height: 1.6,
                        ),
                        textAlign: TextAlign.center,
                      ),
                      const SizedBox(height: 32),
                      Container(
                        decoration: BoxDecoration(
                          gradient: LinearGradient(
                            colors: [AppTheme.primaryGold, AppTheme.primaryGold.withOpacity(0.9)],
                          ),
                          borderRadius: BorderRadius.circular(16),
                          boxShadow: [
                            BoxShadow(
                              color: AppTheme.primaryGold.withOpacity(0.4),
                              blurRadius: 16,
                              offset: const Offset(0, 8),
                            ),
                          ],
                        ),
                        width: double.infinity,
                        child: Material(
                          color: Colors.transparent,
                          child: InkWell(
                            onTap: () => Get.offAllNamed(AppRoutes.dashboard),
                            borderRadius: BorderRadius.circular(16),
                            child: Padding(
                              padding: const EdgeInsets.symmetric(vertical: 16),
                              child: Text(
                                'Back to Dashboard',
                                style: TextStyle(
                                  fontSize: 16,
                                  fontWeight: FontWeight.bold,
                                  color: AppTheme.charcoalBlack,
                                  letterSpacing: 0.3,
                                ),
                                textAlign: TextAlign.center,
                              ),
                            ),
                          ),
                        ),
                      ),
                    ],
                  ),
                ),
              ),
            ),
          ),
        ),
      ),
    );
  }
}